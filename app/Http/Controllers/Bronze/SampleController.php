<?php

namespace App\Http\Controllers\Bronze;

use App\User;
use App\UserAccountStatus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SampleController extends Controller
{
    public function test() {
        $samples = [
            [
                "name" => "SecureLife01",
                "email" => "SecureLife01@SecureLife.com"
            ],
            [
                "name" => "SecureLife02",
                "email" => "SecureLife02@SecureLife.com"
            ],
            [
                "name" => "SecureLife03",
                "email" => "SecureLife03@SecureLife.com"
            ],
            [
                "name" => "SecureLife04",
                "email" => "SecureLife04@SecureLife.com"
            ],
            [
                "name" => "SecureLife05",
                "email" => "SecureLife05@SecureLife.com"
            ],
            [
                "name" => "SecureLife06",
                "email" => "SecureLife06@SecureLife.com"
            ],
            [
                "name" => "SecureLife07",
                "email" => "SecureLife07@SecureLife.com"
            ],
            [
                "name" => "Amalia Carpenter",
                "email" => "amaliacarpenter@baluba.com"
            ],
            [
                "name" => "Cotton Bush",
                "email" => "cottonbush@baluba.com"
            ],
            [
                "name" => "Doris Obrien",
                "email" => "dorisobrien@baluba.com"
            ],
            [
                "name" => "Emilia Hernandez",
                "email" => "emiliahernandez@baluba.com"
            ],
            [
                "name" => "Angeline Turner",
                "email" => "angelineturner@baluba.com"
            ],
            [
                "name" => "Holland Hines",
                "email" => "hollandhines@baluba.com"
            ],
            [
                "name" => "Luella Petty",
                "email" => "luellapetty@baluba.com"
            ],
            [
                "name" => "Rosemary Morse",
                "email" => "rosemarymorse@baluba.com"
            ],
            [
                "name" => "Roberts Lee",
                "email" => "robertslee@baluba.com"
            ],
            [
                "name" => "Rosario Barton",
                "email" => "rosariobarton@baluba.com"
            ],
            [
                "name" => "Espinoza Espinoza",
                "email" => "espinozaespinoza@baluba.com"
            ],
            [
                "name" => "Sheena Camacho",
                "email" => "sheenacamacho@baluba.com"
            ],
            [
                "name" => "Christian Kennedy",
                "email" => "christiankennedy@baluba.com"
            ],
            [
                "name" => "Wells King",
                "email" => "wellsking@baluba.com"
            ],
            [
                "name" => "Peck Rodgers",
                "email" => "peckrodgers@baluba.com"
            ],
            [
                "name" => "Winifred Kent",
                "email" => "winifredkent@baluba.com"
            ],
            [
                "name" => "Leon Newman",
                "email" => "leonnewman@baluba.com"
            ],
            [
                "name" => "Carney Russo",
                "email" => "carneyrusso@baluba.com"
            ],
            [
                "name" => "Valerie Francis",
                "email" => "valeriefrancis@baluba.com"
            ],
            [
                "name" => "Lucy Wade",
                "email" => "lucywade@baluba.com"
            ],
            [
                "name" => "Barbra Navarro",
                "email" => "barbranavarro@baluba.com"
            ],
            [
                "name" => "Johnson Saunders",
                "email" => "johnsonsaunders@baluba.com"
            ],
            [
                "name" => "Holmes Lewis",
                "email" => "holmeslewis@baluba.com"
            ],
            [
                "name" => "Fisher Russell",
                "email" => "fisherrussell@baluba.com"
            ],
            [
                "name" => "Deborah Boyer",
                "email" => "deborahboyer@baluba.com"
            ],
            [
                "name" => "Mckee Huber",
                "email" => "mckeehuber@baluba.com"
            ],
            [
                "name" => "Emily Blackwell",
                "email" => "emilyblackwell@baluba.com"
            ],
            [
                "name" => "Lawson Harrell",
                "email" => "lawsonharrell@baluba.com"
            ],
            [
                "name" => "Rivera Harrison",
                "email" => "riveraharrison@baluba.com"
            ],
            [
                "name" => "Alexandria Guthrie",
                "email" => "alexandriaguthrie@baluba.com"
            ],
            [
                "name" => "Jefferson Acevedo",
                "email" => "jeffersonacevedo@baluba.com"
            ],
            [
                "name" => "Weiss Conway",
                "email" => "weissconway@baluba.com"
            ],
            [
                "name" => "Ethel Henry",
                "email" => "ethelhenry@baluba.com"
            ],
            [
                "name" => "Jenny Whitaker",
                "email" => "jennywhitaker@baluba.com"
            ],
            [
                "name" => "Miranda Acosta",
                "email" => "mirandaacosta@baluba.com"
            ],
            [
                "name" => "Kate Tanner",
                "email" => "katetanner@baluba.com"
            ],
            [
                "name" => "Anderson Pearson",
                "email" => "andersonpearson@baluba.com"
            ],
            [
                "name" => "Norman Gray",
                "email" => "normangray@baluba.com"
            ],
            [
                "name" => "Murray Mcdonald",
                "email" => "murraymcdonald@baluba.com"
            ],
            [
                "name" => "Jody Fischer",
                "email" => "jodyfischer@baluba.com"
            ],
            [
                "name" => "Leola Mcclain",
                "email" => "leolamcclain@baluba.com"
            ],
            [
                "name" => "Elvia Mendez",
                "email" => "elviamendez@baluba.com"
            ],
            [
                "name" => "Hillary Livingston",
                "email" => "hillarylivingston@baluba.com"
            ],
            [
                "name" => "Bessie Kirk",
                "email" => "bessiekirk@baluba.com"
            ],
            [
                "name" => "Kerry Lawrence",
                "email" => "kerrylawrence@baluba.com"
            ],
            [
                "name" => "Weaver White",
                "email" => "weaverwhite@baluba.com"
            ],
            [
                "name" => "Gillespie Cabrera",
                "email" => "gillespiecabrera@baluba.com"
            ],
            [
                "name" => "Nelson Gregory",
                "email" => "nelsongregory@baluba.com"
            ],
            [
                "name" => "Woodard Burch",
                "email" => "woodardburch@baluba.com"
            ],
            [
                "name" => "Hartman Chavez",
                "email" => "hartmanchavez@baluba.com"
            ]
        ];
        $id = 1;
        foreach($samples as $item) {
            $user = new User;
            $user->name = $item['name'];
            $user->firstname = 'A';
            $user->lastname = 'B';
            $user->mi = 'C';
            $user->email = $item['email'];
            $user->password = bcrypt('12341234');
            $user->type = 'user';
            $user->photo = 'user.png';
            $user->status = 'inactive';
            $user->address = 'null';
            $user->sponsor = 'securelife';
            $user->birthdate = '2019-01-13';
            $user->contact = '+63999999999';
            $user->code = 'SLB-'.(1000 + $id);
            $user->save();

            $userAccountStatus = new UserAccountStatus;
            $userAccountStatus->user_id = $id;
            $userAccountStatus->status = 'active';
            $userAccountStatus->save();
            $id++;
        }
    }
}
