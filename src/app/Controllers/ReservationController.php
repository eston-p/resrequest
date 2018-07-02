<?php

namespace App\Controllers;


use App\Validation\Validation;

class ReservationController
{
    protected $PDO;

    public function __construct(\PDO $PDO)
    {
        $this->PDO = $PDO;
    }

    public function index()
    {

    }

    public function store()
    {

        $name = $_POST['name'];
        $date = $_POST['date'];
        $num_Rooms = $_POST['num_Rooms'];
        $email = $_POST['email'];

        $validation = new Validation();

        $validate = $validation->validation([
            $name => 'required',
            $date => 'required|date',
            $num_Rooms => 'required|int',
            $email => 'required|email',
        ]);

            $statement = $this->PDO->prepare("INSERT INTO reservations(name, date, num_rooms, email) VALUES(:fname, :fdate, :fnum_rooms, :femail)");
            $statement->execute([
                'fname' => $name,
                'fdate' => $date,
                'fnum_rooms' => $num_Rooms,
                'femail' => $email,
            ]);

    }
}