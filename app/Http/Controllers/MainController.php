<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function welcome()
    {
        return response()->json([
            'message' => 'Welcome to the API!'
        ]);
    }

    public function currentTime()
    {
        return response()->json([
            'current_time' => 'Hora Atual do Servidor: ' . now()
        ]);
    }

    public function currentDate()
    {
        return response()->json([
            'current_date' => 'Data Atual do Servidor: ' . today()
        ]);
    }

    public function greetClient($name)
    {
        return response()->json([
            'message' => 'Olá, ' . ucfirst($name) . '! Seja bem-vindo à API!'
        ]);
    }

    public function sum(Request $request)
    {
        $value1 = $request->input('value1');
        $value2 = $request->input('value2');
        $sum = $value1 + $value2;
        return response()->json([
            'message' => "{$value1} + {$value2} : Result = {$sum}"
        ]);
    }


    public function storeContact(Request $request)
    {

        $nome = $request->input('name');
        $email = $request->input('email');

        $newContact = [
            'name' => $nome,
            'email' => $email
        ];


        file_put_contents(storage_path('contacts.txt'), json_encode($newContact) . PHP_EOL, FILE_APPEND);

        return response()->json([
            'message' => "Contacto {$nome} e Email: {$email} armazenado com sucesso!",
        ]);
    }


    public function getContacts()
    {
        $contactsFile = storage_path('contacts.txt');
        if (file_exists($contactsFile) == false) {
            return response()->json([
                'status' => 'error',
                'message' => 'No contacts found.'
            ]);
        }
        $file = fopen($contactsFile, 'r');
        $contacts = [];
        while (($line = fgets($file)) != false) {
            $contacts[] = json_decode($line, true);
        }

        fclose($file);

        return response()->json([
            'status' => 'success',
            'contacts' => $contacts
        ]);
    }


    public function clearContacts()
    {
        $contactsFile = storage_path('contacts.txt');

        if(file_exists($contactsFile)){
            unlink($contactsFile);

               return response()->json([
            'status' => 'success',
            'message' => 'Todos os contatos foram removidos.'
        ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No contacts to clear.'
            ]);
        }


     
    }
}
