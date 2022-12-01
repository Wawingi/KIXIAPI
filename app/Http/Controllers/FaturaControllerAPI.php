<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class FaturaControllerAPI extends Controller
{

    public static function listarFaturaAPI()
    {

        $tipoFactura = "'GF'";
        $fatura = DB::connection('sqlsrv2')->select('SELECT TOP(100) F.ccoNumero as ccoNumero, F.cleCodigo as cleCodigo, C.cleNomeCliente as nomeCliente, C.cleTelefone as cleTelefone, F.ccoDataEmissao as  ccoDataEmissao
        FROM            Fatura.tbeCabecalho AS F INNER JOIN
        Fatura.tbeDetalhe AS F1 ON F.ccoNumero = F1.ccoNumero INNER JOIN
        Cliente.tbeCliente AS C ON F.cleCodigo = C.cleCodigo
        COLLATE Modern_Spanish_CI_AI WHERE LEFT( F.ccoNumero, 2 ) = ' . $tipoFactura . ' order by ccoNumero DESC');

        return $fatura;
    }

    public static function getDadosFacturaAPI($codigoFactura)
    {
        $codigoFactura = "'$codigoFactura'";
        $fatura = DB::connection('sqlsrv2')->select('SELECT F.ccoNumero, F.SAFTInvoiceNo,C.cleNomeCliente AS cleNomeCliente, F1.ccoCodigo, F.cleCodigo, F.ccoDataEmissao, F.ccoDataRegisto, F.ccoSubTotal, F.ccoIVA, F.ccoTotal, S.ccoDescripcao AS Designacao, F1.dteMontante, F1.dteIva AS dteMontante, F1.ivaRegime,I.SAFTTaxExemptionCode AS TaxExemptionCode, I.ivaPercentagem AS TaxPercentage, 
        1 AS quantidade FROM            Fatura.tbeCabecalho AS F INNER JOIN
        Fatura.tbeDetalhe AS F1 ON F.ccoNumero = F1.ccoNumero INNER JOIN
        Fatura.tbeConceito AS S ON S.ccoCodigo = F1.ccoCodigo INNER JOIN
        Fatura.tbeIva AS I ON S.ccoCodigo = I.ccoCodigo INNER JOIN
        Cliente.tbeCliente AS C ON F.cleCodigo = C.cleCodigo COLLATE Modern_Spanish_CI_AI WHERE F.ccoNumero=' . $codigoFactura . '');

        return $fatura;
    }

    public static function getDadosEmpresaAPI()
    {
        $empresa = DB::connection('sqlsrv2')->select('SELECT * FROM Geral.tbeEmpresa');
        return $empresa;
    }

    public static function ClienteEspecificoAPI($codigoCliente)
    {
        $codigoFactura = "'$codigoCliente'";
        $clientes = DB::connection('sqlsrv2')->select('SELECT * FROM Cliente.tbeCliente WHERE Cliente.tbeCliente.cleCodigo=' . $codigoFactura . '');
        return $clientes;
    }
}
