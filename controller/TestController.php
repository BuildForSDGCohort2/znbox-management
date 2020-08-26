<?php

namespace App\Http\Controllers;
use DB;
use FPDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Report;

class TestController extends Controller
{
	public function invoice() {
		$config = [
			'paper' => 'A4',
			'orientation' => 'P',
			'doc_type' => 'invoice',
			'empresa' => [
				'nome' => 'Tolsoi Investimentos - Sociedade Unipessoal, Lda',
				'morada' => 'Rua da Imprensa, 284 18 Esq, Maputo, Moçambique',
				'telefone' => '',
				'celular' => '+258 846883342',
				'email' => 'mz.tolstoi@gmail.com',
				'nuit' => '400739471',
				'moeda' => 'MZN',
			],
			'documento' => [
				'numero' => '0003/2020',
				'data' => '13.02.2020',
				'data_vencimento' => '13.02.2020',
			],
			'cliente' => [
				'nome' => 'BON-ART Industries Lda.',
				'telefone' => '',
				'email' => '', 
			],
			'lines' => [
				
			],
		];
		$report = new Report($config);
		$document = $report->build()->toString();
		return response($document, 200)->header('Content-Type', 'application/pdf');
	}
}