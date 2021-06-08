<?php

class Matheus_ExportCat_IndexController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $url = $this->getUrl('export_categories/start/index');
	$urlValue = Mage::getSingleton('core/session')->getFormKey();
        $block_content = "
        <h4>Export File Format: </h4>
	<form action='$url' method='post'>
	<select name='file_type'>
		 <option value='xlsx'>XLSX</option>
		 <option value='csv'>CSV</option>
        </select>
	<br><br>
	<input type='hidden' name='form_key' value='$urlValue'>
        <input type='submit' class='btn-export' id='submit' value='Export'>
	</form>

        <style type='text/css'>
        .btn-export{
            display: block;
            border: 0;
            width: 180px;
            background: #4E9CAF;
            padding: 5px 0%;
            text-align: center;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            line-height: 25px; 
            text-decoration: none;
        }
        .btn-export:hover{
            color: #fff;
        }
        </style>"; 
        $this->loadLayout();

        $this->_setActiveMenu('catalog/matheus');
        $block = $this->getLayout()
        ->createBlock('core/text', 'exportcat-block')
        ->setText($block_content);

        $this->_addContent($block);
        $this->renderLayout();
    }
}
