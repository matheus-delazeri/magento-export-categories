<?php

class Matheus_ExportCat_StartController extends Mage_Adminhtml_Controller_Action{
	public function indexAction() {
		/** File format */
		$fileFormat = $this->getRequest()->getPost('file_type');
		/** Create new PHPExcel object */
		require_once dirname(__FILE__).'/../Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$category = Mage::getModel('catalog/category');
		$catTree = $category->getTreeModel()->load();
		$catIds = $catTree->getCollection()->getAllIds();
		array_shift($catIds);
		$this->setHeaderNames($objPHPExcel);
		$row = 2;
		if ($catIds){
			foreach ($catIds as $id){
				$cat = Mage::getModel('catalog/category');
				$cat->load($id);
				$parentId = $cat->getParentId();
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0, $row, $cat->getName())
					->setCellValueByColumnAndRow(1, $row, $cat->getId())
					->setCellValueByColumnAndROw(2, $row, $cat->getDescription())
					->setCellValueByColumnAndROw(3, $row, $cat->getIsActive())
					->setCellValueByColumnAndROw(4, $row, $cat->getUrlKey())
					->setCellValueByColumnAndROw(5, $row, $parentId);
				$cat->load($parentId);
				$objPHPExcel->setActiveSheetIndex()
					->setCellValueByColumnAndRow(6, $row, $cat->getName());

				$row += 1;
			} 
		} 
		/** Save Excel 2007 file */
		$this->saveFile($objPHPExcel, $fileFormat);
	}

	private function setHeaderNames($objPHPExcel){
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValueByColumnAndRow(0, 1, "name")
			->setCellValueByColumnAndRow(1, 1, "id")
			->setCellValueByColumnAndRow(2, 1, "description")
			->setCellValueByColumnAndRow(3, 1, "is_active")
			->setCellValueByColumnAndRow(4, 1, "url_key")
			->setCellValueByColumnAndRow(5, 1, "parent_id")
			->setCellValueByColumnAndRow(6, 1, "parent_name");
	}

	private function saveFile($objPHPExcel, $fileFormat){
		 try{
			 $objPHPExcel->setActiveSheetIndex(0);
			 if($fileFormat == 'xlsx'){
				 $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				 header('Content-type: application/vnd.ms-excel');
				 header('Content-Disposition: attachment; filename="categories.xlsx"');
			 } else{
				 $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
				 header('Content-type: text/csv');
				 header('Content-Disposition: attachment; filename="categories.csv"');
			 }
			 $objWriter->save('php://output');
		 } catch(Exception $e){
			 throw new Exception('Error while saving Excel file.');
		 }
     }
}
