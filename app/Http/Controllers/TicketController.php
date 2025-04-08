<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all()->groupBy('status');
        return view('tickets.index', compact('tickets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required|email',
            'problema' => 'required',
            'descricao' => 'required',
        ]);

        Ticket::create($request->all());

        return redirect()->back()->with('success', 'Ticket criado com sucesso!');
    }

    public function updateStatus(Request $request, Ticket $ticket){
    $request->validate([
        'status' => 'required|in:Aberto,Em andamento,Resolvido',
    ]);

    $ticket->update(['status' => $request->status]);

    return redirect()->back()->with('success', 'Status atualizado com sucesso!');
}
}
