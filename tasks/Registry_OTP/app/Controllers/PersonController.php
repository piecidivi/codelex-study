<?php

namespace App\Controllers;

use App\Services\Persons\StorePersonRequest;
use App\Services\Persons\StorePersonService;
use App\Views\View;
use InvalidArgumentException;

class PersonController extends Controller
{
    private StorePersonService $service;

    public function __construct(StorePersonService $service)
    {
        $this->service = $service;
    }

    public function get(): void
    {
        if (!$_SESSION["userid"]) {
            $this->loginMessage = "Please log in first.";
            echo View::output("login.php.twig", [
                'loginMessage' => $this->loginMessage
            ]);
            return;
        }

        $this->tableLayout = self::TABLE_LAYOUT_DATA;

        if (empty($_GET)) {
            $this->tableLayout = self::TABLE_LAYOUT_INIT;
            $this->tableMessage = "Something went wrong. Please try again.";
            echo View::output("home.php.twig", [
                "tableMessage" => $this->tableMessage,
                "tableLayout" => $this->tableLayout
            ]);
            return;
        }

        $search = trim($_GET["search"]);
        try {
            $result = $this->service->get($search);
        } catch (InvalidArgumentException $exception) {
            $this->tableLayout = self::TABLE_LAYOUT_INIT;
            $this->tableMessage = $exception->getMessage();
            echo View::output("home.php.twig", [
                "tableMessage" => $this->tableMessage,
                "tableLayout" => $this->tableLayout
            ]);
            return;
        }

        $count = count($result);
        $this->tableMessage = "There are {$count} matching data entries.";
        echo View::output("home.php.twig", [
            "persons" => $result,
            "tableMessage" => $this->tableMessage,
            "tableLayout" => $this->tableLayout
        ]);
    }

    public function getById(): void
    {
        if (!$_SESSION["userid"]) {
            $this->loginMessage = "Please log in first.";
            echo View::output("login.php.twig", [
                'loginMessage' => $this->loginMessage
            ]);
            return;
        }

        $this->formLayout = self::FORM_LAYOUT_GET;
        $this->formMessage = "nbsp;";

        if (empty($_GET)) {
            $this->tableLayout = self::TABLE_LAYOUT_INIT;
            $this->tableMessage = "Something went wrong. Please try again.";
            echo View::output("home.php.twig", [
                "tableMessage" => $this->tableMessage,
                "tableLayout" => $this->tableLayout
            ]);
            return;
        }

        $search = trim($_GET["submit"]);
        try {
            $person = $this->service->getById($search);
        } catch (InvalidArgumentException $exception) {
            $this->tableLayout = self::TABLE_LAYOUT_INIT;
            $this->tableMessage = $exception->getMessage();
            echo View::output("home.php.twig", [
                "tableMessage" => $this->tableMessage,
                "tableLayout" => $this->tableLayout
            ]);
            return;
        }

        $this->formLayout = self::FORM_LAYOUT_GET;
        $this->formMessage = "&nbsp;";
        echo View::output("detail.php.twig", [
            "person" => $person,
            "formMessage" => $this->formMessage,
            "formLayout" => $this->formLayout
        ]);
    }

    public function detail(): void
    {
        if (!$_SESSION["userid"]) {
            $this->loginMessage = "Please log in first.";
            echo View::output("login.php.twig", [
                'loginMessage' => $this->loginMessage
            ]);
            return;
        }

        if (empty($_POST)) {
            $this->tableLayout = self::TABLE_LAYOUT_INIT;
            $this->tableMessage = "Something went wrong. Please try again.";
            echo View::output("home.php.twig", [
                "tableMessage" => $this->tableMessage,
                "tableLayout" => $this->tableLayout
            ]);
            return;
        }

        $this->postName = $_POST["submit"];
        $this->pageName = ($this->postName === "add") ? "new" : "detail";
        $personalCode = trim($_POST["personal_code"]);
        $firstName = trim($_POST["first_name"]);
        $lastName = trim($_POST["last_name"]);
        $age = trim($_POST["age"]);
        $address = trim($_POST["address"]);
        $description = trim($_POST["description"]);

        if (!$this->validatePersonalCode($personalCode)) {
            $this->formLayout = self::FORM_LAYOUT_POST;
            $this->formMessage = "Invalid personal code format.";
            echo View::output("{$this->pageName}.php.twig", [
                "formMessage" => $this->formMessage,
                "formLayout" => $this->formLayout,
                "personalCode" => $personalCode,
                "firstName" => $firstName,
                "lastName" => $lastName,
                "age" => $age,
                "address" => $address,
                "description" => $description
            ]);
            return;
        }

        if (!$this->validateName($firstName) || !$this->validateName($firstName)) {
            $this->formLayout = self::FORM_LAYOUT_POST;
            $this->formMessage = "Name must not contain numbers or other special characters.";
            echo View::output("{$this->pageName}.php.twig", [
                "formMessage" => $this->formMessage,
                "formLayout" => $this->formLayout,
                "personalCode" => $personalCode,
                "firstName" => $firstName,
                "lastName" => $lastName,
                "age" => $age,
                "address" => $address,
                "description" => $description
            ]);
            return;
        }

        if (!$this->validateAge($age)) {
            $this->formLayout = self::FORM_LAYOUT_POST;
            $this->formMessage = "Age has to consist of numbers.";
            echo View::output("{$this->pageName}.php.twig", [
                "formMessage" => $this->formMessage,
                "formLayout" => $this->formLayout,
                "personalCode" => $personalCode,
                "firstName" => $firstName,
                "lastName" => $lastName,
                "age" => $age,
                "address" => $address,
                "description" => $description
            ]);
            return;
        }

        if (!$this->validateAddress($address)) {
            $this->formLayout = self::FORM_LAYOUT_POST;
            $this->formMessage = "Address must be at least one character long.";
            echo View::output("{$this->pageName}.php.twig", [
                "formMessage" => $this->formMessage,
                "formLayout" => $this->formLayout,
                "personalCode" => $personalCode,
                "firstName" => $firstName,
                "lastName" => $lastName,
                "age" => $age,
                "address" => $address,
                "description" => $description
            ]);
            return;
        }

        try {
            $this->service->{$this->postName}(new StorePersonRequest($personalCode, $firstName, $lastName, $age, $address, $description));
        } catch (InvalidArgumentException $exception) {
            $this->formLayout = self::FORM_LAYOUT_POST;
            $this->formMessage = $exception->getMessage();
            echo View::output("{$this->pageName}.php.twig", [
                "formMessage" => $this->formMessage,
                "formLayout" => $this->formLayout,
                "personalCode" => $personalCode,
                "firstName" => $firstName,
                "lastName" => $lastName,
                "age" => $age,
                "address" => $address,
                "description" => $description
            ]);
            return;
        }

        $this->tableMessage = "Activity was successful!";
        $this->tableLayout = self::TABLE_LAYOUT_INIT;
        echo View::output("home.php.twig", [
            'tableMessage' => $this->tableMessage,
            'tableLayout' => $this->tableLayout
        ]);
    }

    public function add(): void
    {
        if (!$_SESSION["userid"]) {
            $this->loginMessage = "Please log in first.";
            echo View::output("login.php.twig", [
                'loginMessage' => $this->loginMessage
            ]);
            return;
        }

        $this->formMessage = "&nbsp";
        $this->formLayout = self::FORM_LAYOUT_GET;
        echo View::output("new.php.twig", [
            "formMessage" => $this->formMessage,
            "formLayout" => $this->formLayout
        ]);
    }
}