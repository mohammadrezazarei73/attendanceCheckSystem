<?php
namespace app\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Session;
class SessionExport implements FromView
{
    public function __construct(Session $session)
    {
        $this->session = $session;
    }
    public function view(): View
    {
        return view('excel.session', [
            'session' =>$this->session
        ]);
    }
}