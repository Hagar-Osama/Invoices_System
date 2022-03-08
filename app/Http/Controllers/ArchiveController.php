<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ArchiveInterface;
use App\Http\Requests\DeleteArchiveRequest;
use App\Http\Requests\DeleteInvoicesRequest;
use App\Http\Requests\UpdateArchiveRequest;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    private $archiveInterface;
    public function __construct(ArchiveInterface $archives)
    {
        $this->archiveInterface = $archives;

    }

    public function showArchivedInvoices()
    {
        return $this->archiveInterface->showArchivedInvoices();
    } 

    public function updateArchives(UpdateArchiveRequest $request)
    {
        return $this->archiveInterface->updateArchives($request);
    }

    public function destroy(DeleteInvoicesRequest $request)
    {
        return $this->archiveInterface->destroy($request);
    }
}
