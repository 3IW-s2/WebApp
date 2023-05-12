<?php

//Commentaire 
/*
	String, Float, Bool, Int et Null
	Auto déclaré
	Auto typé
	Typage dynamique
	
	Convention :
	CamelCase
	Anglais
	$
	Cohérence
	Ne commence pas par un chiffre

	Pointeur avec passage de la référence "&"
*/

/*


$age = 18;

if ($age === "18") {
	echo "Tout juste majeur";
} elseif ($age > 18) {
	echo "Majeur";
} else {
	echo "Mineur";
}

$scope = "admin";

switch ($scope) {
	case 'admin':
		echo "Peut modifier la config";
	case 'author':
		echo "Peut modifier le contenu";
	default:
		echo "Peut visualiser le site";
		break;
}


//Condition ternaire
// -> Juste un if et un else
// -> une instruction commune et unique

$age = 20;

if ($age >= 18)
	echo "Majeur";
else
	echo "Mineur";

//Instruction (condition)?vrai:faux;
echo ($age >= 18) ? "Majeur" : "Mineur";

//Le null coalescent

$var = null;
if ($var != null) {
	echo $var;
}else{
	echo "Default";
}

echo ($var != null) ? $var : "Default";

echo $var ?? "Default";

//Incrémentation et décrémentation
$cpt = 0;
++$cpt;
$cpt++;
$cpt += 1;
$cpt = $cpt + 1;

$cpt = 0;
echo $cpt; // 0
echo $cpt + 1;// 1
echo ++$cpt; //1
echo $cpt; //1
echo $cpt = $cpt + 1; // 2
echo $cpt += 1; // 3
echo $cpt--; //3
echo --$cpt; //1
//Boucles PHP
// -> For : nombre d'itération connu
// -> While : nombre d'itération inconnu
// -> Do While :  nombre d'itération inconnu mais au moins 1
// -> Foreach : parcourir un tableau

for ($i = 0; $i < 10; $i++) {
	// 
}


$dice = rand(1,6);
$cpt = 1;
while ($dice != 6) {
	$dice = rand(1,6);
	$cpt++;
}


$cpt = 0;
do {
	$dice = rand(1,6);
	$cpt++;
} while ($dice != 6);


//Tableaux

$array = [];
//$array = array();

$student = ["Arthur", "BLANDIN", 10];


$student[] = 17;


$student = [
			"lastname"=>"Pierre",
			3 => 32 ,
			"firstname"=>"Michel", 
			"average"=>12
		];

//Afficher Prénom Nom a une moyenne de Note
echo $student["firstname"]. " " .$student["lastname"]." a une moyenne de ".$student["average"];

$student[] = 12;

echo "<pre>";
print_r($student);
echo "</pre>";

//Dim : Profondeur


$class = [
				0=>["Prénom", "NOM"],
				["Prénom", "NOM"],
				2=>[0=>"Toto", 1=>"NOM"],
				["Prénom", "NOM"],
				[ ["Titi", "Tata"] , "NOM"],
		]; //3D

//echo $class[2][0];

$array = [
			0=>[],
			1=>[
				0=>[
					0=>[],
					1=>[
						0=>[
							0=>[
								0=>[
									0=>[0=>"toto"]
								],
								1=>[]
							]
						],
						1=>[]
					]
				]
			]
		]; //8D

		//echo $array[1][0][1][0][0][0][0][0];


//FOREACH

$fruits = [0=>"Banana", 1=>"Apple", "Cherry", "Pineapple"];


echo "<ul>";
foreach ($fruits as $key => $fruit) {
	echo "<li> Le fruit N°".$key." c'est : ".$fruit."</li>";
}
echo "</ul>";

*/



//Functions
function helloWorld(): void
{
	//echo "Bonjour tout le monde";
}

helloWorld();







function helloYou(String $firstname): void
{
	//echo "Bonjour ".$firstname;
}

$firstname = "Yves";
helloYou($firstname);


function cleanAndCheckLastname(String &$lastname): Bool
{
	$lastname = strtoupper(trim($lastname));
	return strlen($lastname) >= 2;
}



$lastname = "  s ";
echo(cleanAndCheckLastname($lastname) ? "OK " : "NOK ").$lastname;
