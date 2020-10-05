<?php

namespace controller\report;

use controller\report\Invoice;
use controller\report\Proforma;
use controller\report\Receipt;
use controller\Translator;

class Report {

	private $paper = "A4";
	private $orientation = "P";	# P -> Portrait
	private $doctype = "";
	private $pdf = null;

	public function invoice($config) {
		$this->pdf = new Invoice($this->orientation, "mm", $this->paper);

		$this->pdf->config = $config;

		$config = (object) $config;
		$enterprise = (object) $config->enterprise;
		$customer = (object) $config->customer;
		$document = (object) $config->document;

		$pdf = $this->pdf;
		$pdf->AddPage();
		$pdf->SetAutoPageBreak(false, -150);
		$pdf->SetFont('Arial', 'B', 9);
		$pdf->Ln(0);

		$table_y = 190;
		/* Table header */
		$pdf->Cell(0, $table_y, utf8_decode(Translator::translate("Description")));
		$pdf->SetX(100);
		$pdf->Cell(0, $table_y, utf8_decode(Translator::translate("Quantity")));
		$pdf->SetX(130);
		$pdf->Cell(0, $table_y, utf8_decode(Translator::translate("Price/Unit")));
		$pdf->SetX(170);
		$pdf->Cell(0, $table_y, utf8_decode(Translator::translate("Total")));
		/* Table header end */
		$pdf->SetLineWidth(0.5);
		$line_itens_y = 110;
		$pdf->Line(10, $line_itens_y, 200, 110);

		/* Table itens */
		$pdf->Ln(0);
		$pdf->SetFont('Arial', '', 8);
		$table_aux_y = $table_y;
		$x = $pdf->getX();
		$y = $pdf->getY();
		foreach ($document->itens as $item) {
			$table_aux_y += 20;
			$line_itens_y += 10;
			$pdf->SetXY($x, $line_itens_y - 10 + 2);
			$pdf->MultiCell(80, 5, utf8_decode($item["description"]));
			
			$word_width = $pdf->GetStringWidth($item["description"]);
			$lines_number = $word_width / 80;
			$pdf->SetXY(100, $line_itens_y  - 10);
			$pdf->MultiCell(80, 10, utf8_decode($item["quantity"]));
			$pdf->SetXY(130, $line_itens_y  - 10);
			$pdf->MultiCell(30, 10, utf8_decode($item["price"]));
			$pdf->SetXY(170, $line_itens_y  - 10);
			$pdf->MultiCell(30, 10, utf8_decode($item["total"]));
			for($i = 0; $i < $lines_number - 1; $i ++) {
				$table_aux_y += 20;
				$line_itens_y += 5;
				$pdf->Ln(0);
			}
			$pdf->Ln(0);
			$pdf->SetLineWidth(0.1);
			$pdf->SetDash(0.5, 1);
			$pdf->Line(10, $line_itens_y, 200, $line_itens_y);
			if($table_aux_y >= 400) {
				$pdf->AddPage();
				$pdf->SetAutoPageBreak(false, -150);
				$pdf->SetFont('Arial', 'B', 9);
				$pdf->Ln(0);

				$table_y = 190;
				/* Table header */
				$pdf->Cell(0, $table_y, utf8_decode("Description"));
				$pdf->SetX(100);
				$pdf->Cell(0, $table_y, utf8_decode("Quantity"));
				$pdf->SetX(130);
				$pdf->Cell(0, $table_y, utf8_decode("Price/Unit"));
				$pdf->SetX(170);
				$pdf->Cell(0, $table_y, utf8_decode("Total"));
				/* Table header end */
				$pdf->SetLineWidth(0.5);
				$line_itens_y = 110;
				$pdf->Line(10, $line_itens_y, 200, 110);

				/* Table itens */
				$pdf->Ln(0);
				$pdf->SetFont('Arial', '', 8);
				$table_aux_y = $table_y;
			}
		}
		$pdf->SetDash();
		//die();
		$this->pdf = $pdf;

		return $this;
	}
	public function proforma($config) {
		$this->pdf = new Proforma($this->orientation, "mm", $this->paper);

		$this->pdf->config = $config;

		$config = (object) $config;
		$enterprise = (object) $config->enterprise;
		$customer = (object) $config->customer;
		$document = (object) $config->document;

		$pdf = $this->pdf;
		$pdf->AddPage();
		$pdf->SetAutoPageBreak(false, -150);
		$pdf->SetFont('Arial', 'B', 9);
		$pdf->Ln(0);

		$table_y = 190;
		/* Table header */
		$pdf->Cell(0, $table_y, utf8_decode(Translator::translate("Description")));
		$pdf->SetX(100);
		$pdf->Cell(0, $table_y, utf8_decode(Translator::translate("Quantity")));
		$pdf->SetX(130);
		$pdf->Cell(0, $table_y, utf8_decode(Translator::translate("Price/Unit")));
		$pdf->SetX(170);
		$pdf->Cell(0, $table_y, utf8_decode(Translator::translate("Total")));
		/* Table header end */
		$pdf->SetLineWidth(0.5);
		$line_itens_y = 110;
		$pdf->Line(10, $line_itens_y, 200, 110);

		/* Table itens */
		$pdf->Ln(0);
		$pdf->SetFont('Arial', '', 8);
		$table_aux_y = $table_y;
		$x = $pdf->getX();
		$y = $pdf->getY();
		foreach ($document->itens as $item) {
			$table_aux_y += 20;
			$line_itens_y += 10;
			$pdf->SetXY($x, $line_itens_y - 10 + 2);
			$pdf->MultiCell(80, 5, utf8_decode($item["description"]));
			
			$word_width = $pdf->GetStringWidth($item["description"]);
			$lines_number = $word_width / 80;
			$pdf->SetXY(100, $line_itens_y  - 10);
			$pdf->MultiCell(80, 10, utf8_decode($item["quantity"]));
			$pdf->SetXY(130, $line_itens_y  - 10);
			$pdf->MultiCell(30, 10, utf8_decode($item["price"]));
			$pdf->SetXY(170, $line_itens_y  - 10);
			$pdf->MultiCell(30, 10, utf8_decode($item["total"]));
			for($i = 0; $i < $lines_number - 1; $i ++) {
				$table_aux_y += 20;
				$line_itens_y += 5;
				$pdf->Ln(0);
			}
			$pdf->Ln(0);
			$pdf->SetLineWidth(0.1);
			$pdf->SetDash(0.5, 1);
			$pdf->Line(10, $line_itens_y, 200, $line_itens_y);
			if($table_aux_y >= 400) {
				$pdf->AddPage();
				$pdf->SetAutoPageBreak(false, -150);
				$pdf->SetFont('Arial', 'B', 9);
				$pdf->Ln(0);

				$table_y = 190;
				/* Table header */
				$pdf->Cell(0, $table_y, utf8_decode(Translator::translate("Description")));
				$pdf->SetX(100);
				$pdf->Cell(0, $table_y, utf8_decode(Translator::translate("Quantity")));
				$pdf->SetX(130);
				$pdf->Cell(0, $table_y, utf8_decode(Translator::translate("Price/Unit")));
				$pdf->SetX(170);
				$pdf->Cell(0, $table_y, utf8_decode(Translator::translate("Total")));
				/* Table header end */
				$pdf->SetLineWidth(0.5);
				$line_itens_y = 110;
				$pdf->Line(10, $line_itens_y, 200, 110);

				/* Table itens */
				$pdf->Ln(0);
				$pdf->SetFont('Arial', '', 8);
				$table_aux_y = $table_y;
			}
		}
		$pdf->SetDash();
		//die();
		$this->pdf = $pdf;

		return $this;
	}
	public function receipt($config) {
		$this->pdf = new Receipt($this->orientation, "mm", $this->paper);

		$this->pdf->config = $config;

		$config = (object) $config;
		$enterprise = (object) $config->enterprise;
		$customer = (object) $config->customer;
		$document = (object) $config->document;

		$pdf = $this->pdf;
		$pdf->AddPage();
		$pdf->SetAutoPageBreak(false, -150);
		$pdf->SetFont('Arial', 'B', 9);
		$pdf->Ln(0);

		$table_y = 190;
		/* Table header */
		$pdf->Cell(0, $table_y, utf8_decode(Translator::translate("Description")));
		$pdf->SetX(100);
		$pdf->Cell(0, $table_y, utf8_decode(Translator::translate("Quantity")));
		$pdf->SetX(130);
		$pdf->Cell(0, $table_y, utf8_decode(Translator::translate("Price/Unit")));
		$pdf->SetX(170);
		$pdf->Cell(0, $table_y, utf8_decode(Translator::translate("Total")));
		/* Table header end */
		$pdf->SetLineWidth(0.5);
		$line_itens_y = 110;
		$pdf->Line(10, $line_itens_y, 200, 110);

		/* Table itens */
		$pdf->Ln(0);
		$pdf->SetFont('Arial', '', 8);
		$table_aux_y = $table_y;
		$x = $pdf->getX();
		$y = $pdf->getY();
		foreach ($document->itens as $item) {
			$table_aux_y += 20;
			$line_itens_y += 10;
			$pdf->SetXY($x, $line_itens_y - 10 + 2);
			$pdf->MultiCell(80, 5, utf8_decode($item["description"]));
			
			$word_width = $pdf->GetStringWidth($item["description"]);
			$lines_number = $word_width / 80;
			$pdf->SetXY(100, $line_itens_y  - 10);
			$pdf->MultiCell(80, 10, utf8_decode($item["quantity"]));
			$pdf->SetXY(130, $line_itens_y  - 10);
			$pdf->MultiCell(30, 10, utf8_decode($item["price"]));
			$pdf->SetXY(170, $line_itens_y  - 10);
			$pdf->MultiCell(30, 10, utf8_decode($item["total"]));
			for($i = 0; $i < $lines_number - 1; $i ++) {
				$table_aux_y += 20;
				$line_itens_y += 5;
				$pdf->Ln(0);
			}
			$pdf->Ln(0);
			$pdf->SetLineWidth(0.1);
			$pdf->SetDash(0.5, 1);
			$pdf->Line(10, $line_itens_y, 200, $line_itens_y);
			if($table_aux_y >= 400) {
				$pdf->AddPage();
				$pdf->SetAutoPageBreak(false, -150);
				$pdf->SetFont('Arial', 'B', 9);
				$pdf->Ln(0);

				$table_y = 190;
				/* Table header */
				$pdf->Cell(0, $table_y, utf8_decode("Description"));
				$pdf->SetX(100);
				$pdf->Cell(0, $table_y, utf8_decode("Quantity"));
				$pdf->SetX(130);
				$pdf->Cell(0, $table_y, utf8_decode("Price/Unit"));
				$pdf->SetX(170);
				$pdf->Cell(0, $table_y, utf8_decode("Total"));
				/* Table header end */
				$pdf->SetLineWidth(0.5);
				$line_itens_y = 110;
				$pdf->Line(10, $line_itens_y, 200, 110);

				/* Table itens */
				$pdf->Ln(0);
				$pdf->SetFont('Arial', '', 8);
				$table_aux_y = $table_y;
			}
		}
		$pdf->SetDash();
		//die();
		$this->pdf = $pdf;

		return $this;
	}
	public function toString() {

		return ($this->pdf) ? $this->pdf->output('S') : '';
	}
}