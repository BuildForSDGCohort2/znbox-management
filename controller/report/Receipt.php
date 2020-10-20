<?php

namespace controller\report;

use FPDF;
use controller\Translator;
use controller\Resources;

class Receipt extends FPDF {

	public $config;

	public function header() {

		$config = (object) $this->config;
		$enterprise = (object) $config->enterprise;

		$this->SetFont('Arial', '', 11);
		$this->Image(__DIR__ ."/../../res/enterprise/".$enterprise->logo, 10, 6, 40);
		$this->SetFont('Arial', 'B', 11);

		$this->SetXY(180, 10);
		$this->SetFont('Arial', 'B', 16);
		$this->SetTextColor(0, 150, 0);
		$this->MultiCell(20, 0, utf8_decode(strtoupper(Translator::translate("Paid"))), 0, "C", false);
		$this->SetTextColor(0, 0, 0);

		if(isset($config->enterprise)) {
			$enterprise = (object) $config->enterprise;
			$customer = (object) $config->customer;
			$document = (object) $config->document;

			/* Header left side */
			$this->Cell(0, 40, utf8_decode($enterprise->name));

			$this->SetFont('Arial', '', 8);
			$this->Ln(0);
			$this->Cell(0, 50, utf8_decode($enterprise->address));
			$this->Ln(0);
			$this->Cell(0, 60, Translator::translate('Contact').': '.utf8_decode($enterprise->phone));
			$this->Ln(0);
			$this->Cell(0, 70, Translator::translate('Contact').': '.utf8_decode($enterprise->mobile));
			$this->Ln(0);
			$this->Cell(0, 80, Translator::translate('E-mail').': '.utf8_decode($enterprise->email));
			$this->Ln(0);
			$this->Cell(0, 90, Translator::translate('Nuit').': '.utf8_decode($enterprise->nuit));

			/* Customer */
			$this->SetFont('Arial', 'B', 10);
			$this->Ln(0);
			$this->Cell(0, 120, utf8_decode(Translator::translate('Invoiced to')));
			$this->Ln(0);
			$this->SetFont('Arial', '', 8);
			$this->Cell(0, 130, utf8_decode($customer->name));
			$this->SetFont('Arial', '', 8);
			$this->Ln(0);
			$this->Ln(0);
			$this->Cell(0, 140, utf8_decode(Translator::translate('Contact').': ').utf8_decode($customer->phone));
			$this->Ln(0);
			$this->Cell(0, 150, utf8_decode(Translator::translate('E-mail').': ').utf8_decode($customer->email));
			$this->Ln(0);
			$this->Cell(0, 160, utf8_decode(Translator::translate('Address').': ').utf8_decode($customer->address));
			$this->Ln(0);
			$this->Cell(0, 170, utf8_decode(Translator::translate('Postal code').': ').utf8_decode($customer->postal_code));

			/* Header right side */
			$col2x = 115;
			$this->SetX($col2x);
			$this->SetFont('Arial', 'B', 8);
			$this->Cell(0, 40, utf8_decode(Translator::translate('Receipt').' Nº: ').utf8_decode($document->number), 0, 0, 'R');
			$this->SetLineWidth(0.3);
			$this->Line($col2x, 32, $col2x + 84, 32);
			$this->Ln(0);
			$this->SetX($col2x);
			$this->SetFont('Arial', '', 8);
			$this->Cell(0, 60, utf8_decode(Translator::translate('Receipt date').': ').utf8_decode($document->date));
			$this->SetFont('Arial', '', 8);
			$this->SetX($col2x);
			$this->Cell(0, 70, utf8_decode(Translator::translate('Payment date').': ').utf8_decode($document->payment_date));
		}
	}

	public function footer() {
		$config = (object) $this->config;
		$enterprise = (object) $config->enterprise;
		$customer = (object) $config->customer;
		$document = (object) $config->document;
		/* Table of total */
		$tab_x = 115;
		$tab_y = 448;
		$tab_line_y = 230;
		$this->Ln(0);
		$this->SetLineWidth(0.3);
		/* Box */
		$this->SetDash();
		$this->Line($tab_x, $tab_line_y, $tab_x + 84, $tab_line_y);
		$this->Line($tab_x, $tab_line_y, $tab_x, $tab_line_y + 30);
		$this->Line($tab_x, $tab_line_y + 30, $tab_x + 84, $tab_line_y + 30);
		$this->Line($tab_x + 84, $tab_line_y, $tab_x + 84, $tab_line_y + 30);
		/* Lines */
		$this->SetXY($tab_x, $tab_line_y);
		$this->MultiCell(43, 10, utf8_decode(Translator::translate("Sub total")));
		$this->SetXY($tab_x + 43, $tab_line_y);
		$this->MultiCell(43, 10, utf8_decode($document->total["subtotal"]));
		$this->SetXY($tab_x, $tab_line_y + 5);
		$this->MultiCell(43, 10, utf8_decode(Translator::translate("Discount")));
		$this->SetXY($tab_x + 43, $tab_line_y + 5);
		$this->MultiCell(43, 10, utf8_decode($document->total["discount"]));
		$this->SetXY($tab_x, $tab_line_y + 10);
		$this->MultiCell(43, 10, utf8_decode(Translator::translate("Subtotal (- discount)")));
		$this->SetXY($tab_x + 43, $tab_line_y + 10);
		$this->MultiCell(43, 10, utf8_decode($document->total["subtotal_discount"]));
		$this->SetXY($tab_x, $tab_line_y + 15);
		$this->MultiCell(43, 10, utf8_decode(Translator::translate("Tax").(($document->total["tax_percentage"]) ? " (".$document->total["tax_percentage"].")" : "").""));
		$this->SetXY($tab_x + 43, $tab_line_y + 15);
		$this->MultiCell(43, 10, utf8_decode($document->total["tax"]));
		$this->Line($tab_x + 84 / 2, $tab_line_y, $tab_x + 84 / 2, $tab_line_y + 30);
		$this->Line($tab_x, $tab_line_y + 6 * 4, $tab_x + 84, $tab_line_y + 6 * 4);

		$this->SetXY($tab_x, $tab_line_y + 20 + 2.5);
		$this->SetFont('Arial', 'B', 8);
		$this->MultiCell(43, 10, utf8_decode(Translator::translate("Total")));
		$this->SetXY($tab_x + 43, $tab_line_y + 20 + 2.5);
		$this->MultiCell(43, 10, utf8_decode($document->total["total"]));
		$this->Ln(0);
		/* Table end */
		$footer_y = 530;
		$this->SetFont('Arial', 'B', 8);
		$this->Ln(0);
		$this->SetDash(0.5, 1);
		$this->SetLineWidth(0.3);
		$this->Line(10, 270, 200, 270);
		$this->Ln(0);
		$this->SetFont('Arial', '', 8);
		$this->SetXY(10, 270);
		$this->MultiCell(43, 10, utf8_decode(Translator::translate("Processed by computer")));
		$this->SetXY((210 / 2) - 15, 270);
		$this->MultiCell(43, 10, utf8_decode(Translator::translate("Printed at"). " " . date("d/m/Y")));
		$this->SetXY(210 - 50, 270);
		$this->MultiCell(43, 10, utf8_decode($this->PageNo()."/{nb}"), 0, "R", false);
		$this->AliasNbPages();
		$this->Ln(0);
		$this->SetDash();
	}

	public function SetDash($black = null, $white = null) {
        if($black !== null) {
        	$s = sprintf('[%.3F %.3F] 0 d', $black * $this->k, $white * $this->k);
        } else {
        	$s = '[] 0 d';
        }
        $this->_out($s);
    }

    function WordWrap(&$text, $maxwidth)
	{
		$text = trim($text);
	    if ($text==='')
	        return 0;
	    $space = $this->GetStringWidth(' ');
	    $lines = explode("\n", $text);
	    $text = '';
	    $count = 0;

	    foreach ($lines as $line)
	    {
	        $words = preg_split('/ +/', $line);
	        $width = 0;

	        foreach ($words as $word)
	        {
	            $wordwidth = $this->GetStringWidth($word);
	            if ($wordwidth > $maxwidth)
	            {
	                // Word is too long, we cut it
	                for($i=0; $i<strlen($word); $i++)
	                {
	                    $wordwidth = $this->GetStringWidth(substr($word, $i, 1));
	                    if($width + $wordwidth <= $maxwidth)
	                    {
	                        $width += $wordwidth;
	                        $text .= substr($word, $i, 1);
	                    }
	                    else
	                    {
	                        $width = $wordwidth;
	                        $text = rtrim($text)."\n".substr($word, $i, 1);
	                        $count++;
	                    }
	                }
	            }
	            elseif($width + $wordwidth <= $maxwidth)
	            {
	                $width += $wordwidth + $space;
	                $text .= $word.' ';
	            }
	            else
	            {
	                $width = $wordwidth + $space;
	                $text = rtrim($text)."\n".$word.' ';
	                $count++;
	            }
	        }
	        $text = rtrim($text)."\n";
	        $count++;
	    }
	    $text = rtrim($text);
	    return $count;
	}
}