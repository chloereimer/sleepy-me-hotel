<?php

require 'application/third_party/tcpdf/tcpdf.php';
 
class Pdf extends TCPDF {
  public function Header() {
  }
  public function Footer() {
  }
  public function CreateTextBox($textval, $x = 0, $y, $width = 0, $height = 10, $fontsize = 10, $fontstyle = '', $align = 'L') {
    $this->SetXY($x+20, $y); // 20 = margin left
    $this->SetFont(PDF_FONT_NAME_MAIN, $fontstyle, $fontsize);
    $this->Cell($width, $height, $textval, 0, false, $align);
  }
}
