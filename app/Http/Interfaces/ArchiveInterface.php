<?php 
namespace App\Http\Interfaces;

interface ArchiveInterface {

    public function showArchivedInvoices();
    
    public function updateArchives($request);

    public function destroy($request);

}