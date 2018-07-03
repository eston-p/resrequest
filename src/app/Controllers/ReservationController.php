<?php

namespace App\Controllers;

use App\Validation\Validation;

class ReservationController
{

    /**
     * @var \PDO
     */
    protected $PDO;

    /**
     * @var null
     */
    protected $container;

    /**
     * ReservationController constructor.
     * @param \PDO $PDO
     * @param null $container
     */
    public function __construct(\PDO $PDO, $container = null)
    {
        $this->PDO = $PDO;

        $this->container = $container;
    }

    /**
     * Method used to save to db
     * @return void
     */
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

            return header('Location: /');
    }

    /**
     * Displays form
     *
     * @return void
     */
    public function search()
    {
        echo $this->container->render('search.php');
    }

    /**
     * Displays search results
     *
     * @return void
     */
    public function show()
    {
        $search = $_POST['search'];
        $statement = $this->PDO->prepare("SELECT * FROM reservations WHERE name LIKE ?");
        $statement->execute(['%'.$search.'%']);
        $results = $statement->fetch();
        echo $this->container->render('results.php', ['results' => $results]);
    }
}