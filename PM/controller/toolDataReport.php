<?php
class toolDataReport extends spController
{
	function index()
	{
		pmAuth("login");
		$this->display('tool/dataReportSet.html');
	}
	
	function show()
	{
		pmAuth("login");
		$modle=spClass('m_product');
		$products=spClass('m_product')->findAll("prod_type<>404");
		//dump($this->spArgs("timeS"));
		$start=$this->spArgs("timeS");
		$end=$this->spArgs("timeE");
		$this->startTime=$start;
		$this->endTime=$end;
		foreach($products as &$product)
		{
			//项目完成量
			$tem=$modle->findSql("select count(0) AS counter from project where proj_endDate>='$start' and proj_endDate<'$end' and proj_state in(10,15) and prod_id=".$product['prod_id']);
			$product["p_total"]=$tem[0]["counter"];
			
			//项目Delay量
			$tem=$modle->findSql("select count(0) AS counter from project where proj_endDate>='$start' and proj_endDate<'$end' and proj_state in(10,15)  and TO_DAYS(proj_endDate)>TO_DAYS(proj_end) and prod_id=".$product['prod_id']);
			$product["p_delay"]=$tem[0]["counter"];
			
			//流程完成量
			$tem=$modle->findSql("select count(0) AS counter from proj_node_v where pnod_time_r>='$start' and pnod_time_r<'$end' and pnod_state in(10,15) and prod_id=".$product['prod_id']);
			$product["n_total"]=$tem[0]["counter"];
			
			//流程delay量
			$tem=$modle->findSql("select count(0) AS counter from proj_node_v where pnod_time_r>='$start' and pnod_time_r<'$end' and pnod_state in(10,15) and TO_DAYS(pnod_time_r)>TO_DAYS(pnod_time_e) and prod_id=".$product['prod_id']);
			$product["n_delay"]=$tem[0]["counter"];
			
			//计算项目计划用时和实际用时（天）
			$product["projectPlanDayCount"]=0;
			$product["projectRealDayCount"]=0;
			$projectsOfThisProduct=$modle->findSql("select TO_DAYS(proj_end)-TO_DAYS(proj_start)+1 AS planDayCount,TO_DAYS(proj_endDate)-TO_DAYS(proj_start)+1 AS realDayCount,TO_DAYS(NOW())-TO_DAYS(proj_start)+1 AS currentDayCount from project where proj_endDate>='$start' and proj_endDate<'$end' and proj_state in(10,15) and prod_id=".$product['prod_id']);
			foreach($projectsOfThisProduct as $project)
			{
				$product["projectPlanDayCount"]+=$project["planDayCount"];
				$product["projectRealDayCount"]+=$project["realDayCount"];
			}
			
			//计算流程计划用时和实际用时（天）
			/*
			$product["nodePlanDayCount"]=0;
			$product["nodeRealDayCount"]=0;
			$projectsOfThisProduct=$modle->findSql("select TO_DAYS(pnod_time_e)-TO_DAYS(pnod_time_s)+1 as planDayCount,TO_DAYS(pnod_time_r)-TO_DAYS(pnod_time_s)+1 as realDayCount from proj_node_v where pnod_time_r>='$start' and pnod_time_r<='$end' and pnod_state in(10,15) and TO_DAYS(pnod_time_r)>TO_DAYS(pnod_time_e) and prod_id=".$product['prod_id']);
			foreach($projectsOfThisProduct as $project)
			{
				$product["nodePlanDayCount"]+=$project["planDayCount"];
				$product["nodeRealDayCount"]+=$project["realDayCount"];
			}
			dump($product);
			*/
		}
		
		//项目完成总量
		$tem=$modle->findSql("select count(0) AS counter from project where proj_endDate>='$start' and proj_endDate<'$end'and proj_state in(10,15)");
		$this->p_total=$tem[0]["counter"];

		//项目DELAY总量
		$tem=$modle->findSql("select count(0) AS counter from project where proj_endDate>='$start' and proj_endDate<'$end'and proj_state in(10,15) and  TO_DAYS(proj_endDate)>TO_DAYS(proj_end)");
		$this->p_delay=$tem[0]["counter"];
			
		//流程完成总量
		$tem=$modle->findSql("select count(0) AS counter from proj_node_v where pnod_time_r>='$start' and pnod_time_r<'$end' and pnod_state in(10,15)");
		$this->n_total=$tem[0]["counter"];
		
		//流程delay总量
		$tem=$modle->findSql("select count(0) AS counter from proj_node_v where pnod_time_r>='$start' and pnod_time_r<'$end' and pnod_state in(10,15) and  TO_DAYS(pnod_time_r)>TO_DAYS(pnod_time_e)");
		$this->n_delay=$tem[0]["counter"];
		
		$this->projectInfo=$products;
		$this->display('tool/DataReport.html');
	}
	
	function exportExcel()
	{
		//dump($modle);
		//die();
		import('extensions/PHPExcel/PHPExcel.php');
		import('extensions/PHPExcel/PHPExcel/Writer/Excel5.php');
		import('extensions/PHPExcel/PHPExcel/Writer/Excel2007.php');
		function aaa()
		{
			dfd;
		}
		// 创建一个处理对象实例
		$objExcel = new PHPExcel();
		
		// 创建文件格式写入对象实例, uncomment
		$objWriter = new PHPExcel_Writer_Excel5($objExcel); // 用于其他版本格式
		// or
		//$objWriter = new PHPExcel_Writer_Excel2007($objExcel); // 用于 2007 格式
		//$objWriter->setOffice2003Compatibility(true);
		//*************************************
		//设置文档基本属性
		$objProps = $objExcel->getProperties();
		$objProps->setCreator("NIEPM");
		$objProps->setLastModifiedBy("NIEPM");
		$objProps->setTitle("NIEPM");
		$objProps->setSubject("NIEPM");
		$objProps->setDescription("NIEPM");
		$objProps->setKeywords("A");
		$objProps->setCategory("B");
		//*************************************
		//设置当前的sheet索引，用于后续的内容操作。
		//一般只有在使用多个sheet的时候才需要显示调用。
		//缺省情况下，PHPExcel会自动创建第一个sheet被设置SheetIndex=0
		$objExcel->setActiveSheetIndex(0);
		
		$objActSheet = $objExcel->getActiveSheet();
		
		//设置当前活动sheet的名称
		$objActSheet->setTitle('PM数据导出');
		
		//*************************************
		//设置单元格内容
		//
		//由PHPExcel根据传入内容自动判断单元格内容类型
		//
		$counter=2;
		$start=$this->spArgs("timeS");
		$end=$this->spArgs("timeE");
		$type=$this->spArgs("target");
		
		switch($type)
		{
			case "project":
				$objActSheet->setCellValue('A1', '产品名');
				$objActSheet->setCellValue('B1', '项目集');
				$objActSheet->setCellValue('C1', '项目ID');
				$objActSheet->setCellValue('D1', '项目名');
				$objActSheet->setCellValue('E1', '访问地址');
				$objActSheet->setCellValue('F1', '计划开始时间');
				$objActSheet->setCellValue('G1', '计划完成时间');
				$objActSheet->setCellValue('H1', '实际完成时间');
				$objActSheet->setCellValue('I1', '计划用时（天）');
				$objActSheet->setCellValue('J1', '实际用时（天）');
				$objActSheet->setCellValue('K1', '负责人');
				$objActSheet->getColumnDimension('A')->setWidth(12);
				$objActSheet->getColumnDimension('B')->setWidth(18);
				$objActSheet->getColumnDimension('C')->setWidth(9);
				$objActSheet->getColumnDimension('D')->setWidth(25);
				$objActSheet->getColumnDimension('E')->setWidth(43);
				$objActSheet->getColumnDimension('F')->setWidth(18);
				$objActSheet->getColumnDimension('G')->setWidth(18);
				$objActSheet->getColumnDimension('H')->setWidth(18);
				$objActSheet->getColumnDimension('I')->setWidth(9);
				$objActSheet->getColumnDimension('J')->setWidth(9);
				$objActSheet->getColumnDimension('K')->setWidth(7);
				$sql="SELECT prod_name,wrap_name,proj_id,proj_name,proj_url,proj_start,proj_end,proj_endDate,TO_DAYS(proj_end)-TO_DAYS(proj_start)+1 as 'planWorkDay',TO_DAYS(proj_endDate)-TO_DAYS(proj_start)+1 as 'realWorkDay',user_name FROM `pm`.`project_v` where proj_endDate>'$start' and  proj_endDate<'$end' and proj_state in(10,15);";
				$modle=spClass("m_project_v")->findSql($sql);
				foreach($modle as $row)
				{
					$objActSheet->setCellValue('A'.$counter,$row['prod_name']);
					$objActSheet->setCellValue('B'.$counter,$row['wrap_name']);
					$objActSheet->setCellValue('C'.$counter,$row['proj_id']);
					$objActSheet->setCellValue('D'.$counter,$row['proj_name']);
					$objActSheet->setCellValue('E'.$counter,$row['proj_url']);
					$objActSheet->getCell('E'.$counter)->getHyperlink()->setUrl($row['proj_url']);
					$objActSheet->getStyle('E'.$counter)->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
                  	$objActSheet->getStyle('E'.$counter)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
					$objActSheet->setCellValue('F'.$counter,$row['proj_start']);
					$objActSheet->setCellValue('G'.$counter,$row['proj_end']);
					$objActSheet->setCellValue('H'.$counter,$row['proj_endDate']);
					$objActSheet->setCellValue('I'.$counter,$row['planWorkDay']);
					$objActSheet->setCellValue('J'.$counter,$row['realWorkDay']);
					$objActSheet->setCellValue('K'.$counter,$row['user_name']);
					$counter++;
				}
				$outputFileName ="PM数据报表_项目_$start.xls";
				break;
			case "pnode":
				$objActSheet->setCellValue('A1', '产品名');
				$objActSheet->setCellValue('B1', '项目ID');
				$objActSheet->setCellValue('C1', '项目名');
				$objActSheet->setCellValue('D1', '流程名');
				$objActSheet->setCellValue('E1', '访问地址');
				$objActSheet->setCellValue('F1', '计划开始时间');
				$objActSheet->setCellValue('G1', '计划完成时间');
				$objActSheet->setCellValue('H1', '实际完成时间');
				$objActSheet->setCellValue('I1', '计划用时（天）');
				$objActSheet->setCellValue('J1', '实际用时（天）');
				$objActSheet->setCellValue('K1', '执行人');
				$objActSheet->getColumnDimension('A')->setWidth(12);
				$objActSheet->getColumnDimension('B')->setWidth(7);
				$objActSheet->getColumnDimension('C')->setWidth(28);
				$objActSheet->getColumnDimension('D')->setWidth(28);
				$objActSheet->getColumnDimension('E')->setWidth(43);
				$objActSheet->getColumnDimension('F')->setWidth(18);
				$objActSheet->getColumnDimension('G')->setWidth(18);
				$objActSheet->getColumnDimension('H')->setWidth(18);
				$objActSheet->getColumnDimension('I')->setWidth(9);
				$objActSheet->getColumnDimension('J')->setWidth(9);
				$objActSheet->getColumnDimension('K')->setWidth(7);
				$sql="SELECT prod_name,proj_id,proj_name,proj_url,pnod_name,pnod_time_s,pnod_time_e,pnod_time_r,TO_DAYS(pnod_time_e)-TO_DAYS(pnod_time_s)+1  as planWorkDay,TO_DAYS(pnod_time_r)-TO_DAYS(pnod_time_s)+1 as realWorkDay,user_name FROM `pm`.`proj_node_v` where pnod_time_r>'$start' and  pnod_time_r<'$end' and pnod_state in(10,15);";
				$modle=spClass("m_project_v")->findSql($sql);
				foreach($modle as $row)
				{
					$objActSheet->setCellValue('A'.$counter,$row['prod_name']);
					$objActSheet->setCellValue('B'.$counter,$row['proj_id']);
					$objActSheet->setCellValue('C'.$counter,$row['proj_name']);
					$objActSheet->setCellValue('D'.$counter,$row['pnod_name']);
					$objActSheet->setCellValue('E'.$counter,$row['proj_url']);
					$objActSheet->getCell('E'.$counter)->getHyperlink()->setUrl($row['proj_url']);
					$objActSheet->getStyle('E'.$counter)->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
                  	$objActSheet->getStyle('E'.$counter)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
					$objActSheet->setCellValue('F'.$counter,$row['pnod_time_s']);
					$objActSheet->setCellValue('G'.$counter,$row['pnod_time_e']);
					$objActSheet->setCellValue('H'.$counter,$row['pnod_time_r']);
					$objActSheet->setCellValue('I'.$counter,$row['planWorkDay']);
					$objActSheet->setCellValue('J'.$counter,$row['realWorkDay']);
					$objActSheet->setCellValue('K'.$counter,$row['user_name']);
					$counter++;
				}
				$outputFileName ="PM数据报表_流程_$start.xls";
				break;
		}
		
		//$objActSheet->setCellValue('A2','aaaa');
		//*************************************
		//输出内容
		//
		ob_clean();
		//到文件
		////$objWriter->save($outputFileName);
		//or
		//到浏览器
		header('content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Type: application/force-download');
		header('Content-Type: application/octet-stream');
		header('Content-Type: application/download');
		header('Content-Disposition:inline;filename="'.$outputFileName.'"');
		header('Content-Transfer-Encoding: binary');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified:' . gmdate("D, d M Y H:i:s") . " GMT");
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: no-cache');
		$objWriter->save('php://output');
	}
}