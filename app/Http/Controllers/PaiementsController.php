<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paiements;
use App\Http\Requests\StorePaiementsRequest;
use App\Http\Requests\UpdatePaiementsRequest;
use Illuminate\Support\Str;
use FedaPay\Transaction;
use App\Models\Payment;
use FedaPay\FedaPay;


class PaiementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaiementsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Paiements $paiements)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paiements $paiements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaiementsRequest $request, Paiements $paiements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paiements $paiements)
    {
        //
    }

    public function __construct()
    {
        // Initialiser FedaPay avec la clé API et l'environnement
        FedaPay::setApiKey(config('fedapay.api_key'));
        FedaPay::setEnvironment(config('fedapay.environment'));
    }

    public function formulaire()
    {
        return view('welcome');
    }
    public function Accespaiement(Request $request)
    {
        $validated = $request->validate([
            'amount'      => 'required|numeric|min:100',
            'currency'    => 'required|in:XOF,XAF,CDF,GNF',
            'phone'       => 'nullable|string|max:20',
            'email'       => 'nullable|email|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        // Créer une référence unique pour notre transaction
        $reference = 'PAY-' . strtoupper(Str::random(10));

        // Enregistrer un statut initial dans la base de données
        $payment = Paiements::create([
            'reference' => $reference,
            'amount'    => $validated['amount'],
            'currency'  => $validated['currency'],
            'phone'     => $validated['phone'] ?? null,
            'email'     => $validated['email'] ?? null,
            'status'    => 'pending',
        ]);

        try {
            // Créer une transaction via l'API FedaPay
            $transaction = Transaction::create([
                'description' => $validated['description'] ?? 'Paiement sur ma plateforme',
                'amount'      => $validated['amount'],
                'currency'    => ['iso' => $validated['currency']],
                'callback_url' => route('payment.success'), // URL de retour après paiement
                'customer'    => [
                    'phone_number' => [
                        'number' => $validated['phone'] ?? '',
                        'country' => 'BJ' // À adapter selon le pays
                    ],
                    'email' => $validated['email'] ?? '',
                ]
            ]);

            

            // Rediriger vers l'URL de paiement FedaPay
            return redirect($transaction->payment_url);

        } catch (\Exception $e) {
            // En cas d'erreur, on met à jour le statut
            return back()->withErrors('Erreur lors de la création du paiement : ' . $e->getMessage());
        }
    } 
    
    
    
    public function Reussite(Request $request)
    {
        // Récupérer l'ID de transaction depuis la query string (?id=xxx)
        $transactionId = $request->query('id');

        if (!$transactionId) {
            return redirect()->route('payment.form')->withErrors('Transaction introuvable.');
        }

        try {
            // Récupérer la transaction depuis FedaPay
            $transaction = Transaction::retrieve($transactionId);

            // Mettre à jour notre base de données
            $payment = Paiements::where('transaction_id', $transactionId)->first();
            // Si le statut est "approved", le paiement est réussi
            if ($transaction->status === 'approved') {
                return view('formulwebhook', compact('transaction'));
            } else {
                return redirect()->route('payment.cancel')->with('message', 'Paiement non approuvé.');
            }

        } catch (\Exception $e) {
            return redirect()->route('payment.form')->withErrors('Erreur de vérification : ' . $e->getMessage());
        }
    }


    public function Annuler(Request $request)
    {
        return view('formulannule');
    }
}
