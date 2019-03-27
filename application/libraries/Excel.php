<?php
class Excel {

    private $excel;

    public function __construct() {
        require_once APPPATH . 'third_party/PHPExcel.php';
        $this->excel = new PHPExcel();
    }

    public function load($path) {
        $objReader = PHPExcel_IOFactory::createReader('Excel5');
        $this->excel = $objReader->load($path);
    }

    public function save($path) {
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save($path);
    }

    public function stream($filename, $data = null,$header = null,$extend = null,$extend2 = null) {
        if ($data != null) {
            $col = 'A';
			$startRow = 0;
			if($header)
			{
				$startRow = 4;
			}
			
			if($extend != null)
			{
				
				$r = 0;
				foreach ($extend as $key => $val)
				{
					$objRichText = new PHPExcel_RichText();
					$objPayable = $objRichText->createTextRun(str_replace("_", " ", $key));
					
					$objRichText2 = new PHPExcel_RichText();
					$objPayable2 = $objRichText2->createTextRun(str_replace("_", " ", $val));
					$this->excel->getActiveSheet()->getCell("A" . ($startRow+$r))->setValue($objRichText);
					$this->excel->getActiveSheet()->getCell("B". ($startRow+$r))->setValue($objRichText2);
					$r++;
				}
				
				$startRow += sizeof($extend)+1;
				
			}
            foreach ($data[0] as $key => $val) {
                $objRichText = new PHPExcel_RichText();
                $objPayable = $objRichText->createTextRun(str_replace("_", " ", $key));
                $this->excel->getActiveSheet()->getCell($col . $startRow)->setValue($objRichText);
                $col++;
            }
			
			if($header)
				$this->excel->getActiveSheet()->getCell("A" . '2')->setValue($header);
			
            $rowNumber = 5;
			if($extend != null)
				 $rowNumber += sizeof($extend)+1;
            foreach ($data as $row) {
                $col = 'A';
                foreach ($row as $cell) {
                    $this->excel->getActiveSheet()->setCellValue($col . $rowNumber, $cell);
                    $col++;
                }
                $rowNumber++;
            }
        }
        header('Content-type: application/ms-excel');
        header("Content-Disposition: attachment; filename=\"" . $filename . "\"");
        header("Cache-control: private");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("export/$filename");
        header("location: " . base_url() . "export/$filename");
        unlink(base_url() . "export/$filename");
    }

    public function __call($name, $arguments) {
        if (method_exists($this->excel, $name)) {
            return call_user_func_array(array($this->excel, $name), $arguments);
        }
        return null;
    }
}