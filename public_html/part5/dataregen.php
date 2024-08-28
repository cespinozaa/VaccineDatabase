<PRE>
<?php
require_once("connection.php");
require_once("vendor/autoload.php");

$faker = Faker\Factory::create();

//delete tables first
$connection->query("DELETE FROM patient;");
$connection->query("DELETE FROM vaccine;");
$connection->query("DELETE FROM vaccinationSite;");

//patient array
$patient = array();
echo "generating patients\n";
//generating 10 patients
for ($i = 0; $i < 10; $i++) {
    $patient[$i]["patientId"] = $faker->unique->randomNumber(9, true);
    $patient[$i]["fName"] = $faker->firstName();
    $patient[$i]["mInitial"] = $faker->randomLetter();
    $patient[$i]["mInitial"] = strtoupper($patient[$i]["mInitial"]);
    $patient[$i]["lName"] = $faker->lastName();
    $patient[$i]["dob"] = $faker->date('Ymd');
    $patient[$i]["weight"] = $faker->numberBetween(50, 210);
}
print_r($patient);

//generating 30 vaccines
$vaccine = array();
echo "generating vaccine\n";

$scientName = ["BNT162b2", "mRNA-1273", "Ad26.COV2.S", "AZD1222","CoronaVac", 
"BBIBP-CorV","COVAXIN","Gam-COVID-Vac", "Flu Vaccine","MMRV Vaccine",
"DTaP Vaccine","Hepatitis B Vaccine","HPV Vaccine","Varicella Vaccine",
"Hib Vaccine", "PCV13 Vaccine","IPV Vaccine","Rabies Vaccine",
"Yellow Fever Vaccine","Typhoid Vaccine","Meningococcal Vaccine",
"Cholera Vaccine","Japanese Encephalitis Vaccine","Shingles Vaccine",
"BCG Vaccine","Rotavirus Vaccine","Tdap Vaccine",
"Pneumococcal Polysaccharide Vaccine", "Poliomyelitis",
"Hepatovirus"];

$disease = ["COVID-19","COVID-19","COVID-19","COVID-19","COVID-19","COVID-19",
"COVID-19","COVID-19","Influenza","Measles, Mumps, Rubella","Diphtheria, Tetanus, Pertussis",
"Hepatitis B","Human Papillomavirus","Chickenpox","Haemophilus influenzae type b",
"Pneumococcal diseases","Polio","Rabies","Yellow Fever","Typhoid Fever",
"Meningococcal Disease","Cholera","Japanese Encephalitis","Shingles (Herpes Zoster)",
"Tuberculosis (BCG)","Rotavirus Infection","Tetanus, Diphtheria, Pertussis",
"Pneumococcal Disease","Polio","Hepatitus A"];

for($i = 0; $i <10; $i++){
    $vaccine[$i]["scientificName"] = $scientName[$i];
    $vaccine[$i]["disease"] = $disease[$i];
    $vaccine[$i]["noDoses"] = $faker->numberBetween(1, 5);
}
print_r($vaccine);

//generating vaccination sites
$vaccinationSite = array();
echo "generating vac sites\n";

for($i = 0; $i <10; $i++){
    $vaccinationSite[$i]["siteName"] = $faker->unique()->company();
    $vaccinationSite[$i]["addrStreet"] = $faker->streetName();
    $vaccinationSite[$i]["addrCity"] = $faker->city();
    $vaccinationSite[$i]["addrState"] = $faker->stateAbbr();
    $vaccinationSite[$i]["addrZip"] = $faker->postcode();
}
print_r($vaccinationSite);

//generating 10 instances of takes
$takes = array();
echo "generating takes";

for($i = 0; $i <10; $i++){
    $takes[$i]["patientId"] = $patient[$i]["patientId"];
    $takes[$i]["siteName"] = $vaccinationSite[rand(0, 9)]["siteName"];
    $takes[$i]["scientificName"] = $vaccine[rand(0, 9)]["scientificName"];
    $takes[$i]["dateTaken"] = $faker->date('Ymd', '-1 year');
}
print_r($takes);

echo "creating associative array";
$allData = array(
    "patient" => $patient,
    "vaccine" => $vaccine,
    "vaccinationSite" => $vaccinationSite,
    "takes" => $takes
);
echo "Done\n";


// create new json file
echo "Creating redump.json..";
$fp = fopen("redump.json", "w");
if (!$fp) die("Couldn't open file");
echo "Done!\n";
echo "Writing json encoded array to file..";
//write the json encoded data to the file
fwrite($fp, json_encode($allData));
//close the file
fclose($fp);
echo "Done!\n";

?>

</PRE>