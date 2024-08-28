<PRE>
<?php
require_once("connection.php");
require_once("vendor/autoload.php");

$faker = Faker\Factory::create();

//patient array
$patient = array();

//generating 5000 patients
echo "generating\n";
for ($i = 0; $i < 5000; $i++) {
    $patient[$i]["patientId"] = $faker->unique->randomNumber(9, true);
    $patient[$i]["fName"] = $faker->firstName();
    $patient[$i]["mInitial"] = $faker->randomLetter();
    $patient[$i]["mInitial"] = strtoupper($patient[$i]["mInitial"]);
    $patient[$i]["lName"] = $faker->lastName();
    $patient[$i]["dob"] = $faker->date('Ymd');
    $patient[$i]["weight"] = $faker->numberBetween(50, 210);
}
print_r($patient);

//generating 3500 insured
$insured_patient = array();

echo "generating insured\n";
for($i = 0; $i <3500; $i++){
    $insured_patient[$i]["patientId"] = $patient[$i]["patientId"];
    $insured_patient[$i]["company"] = $faker->company();
    $insured_patient[$i]["copay"] = $faker->randomFloat(2, 0, 100);
}
echo "done insured\n";
print_r($insured_patient);

//generating 1500 uninsured
$uninsured_patient = array();

echo "generating uninsured\n";
$key = 3500;
for($i = 0; $i < 1500; $i++){
    $uninsured_patient[$i]["patientId"] = $patient[$key]["patientId"];
    $uninsured_patient[$i]["paymentMethod"] = $faker->creditCardType();
    $uninsured_patient[$i]["addrStreet"] = $faker->streetName();
    $uninsured_patient[$i]["addrCity"] = $faker->city();
    $uninsured_patient[$i]["addrState"] = $faker->stateAbbr();
    $uninsured_patient[$i]["addrZip"] = $faker->postcode();
    $key++;
}
echo "done uninsured\n";
print_r($uninsured_patient);

//generating allergies
$allergy = array();
$allergyTypes = ["Peanuts","Gluten","Lactose","Pollen","Shellfish","Dust mites",
"Pet dander","Eggs","Soy","Mold","Latex","Grass","Tree nuts","Insulin",
"Insect stings","Penicillin","Sulfa","Kiwi","Wheat","Corn","Sunflower seeds",
"Pineapple","Avocado","Mustard","Strawberries","Bananas","Cinnamon","Nickel","NSAIDS",
"Alcohol","Chocolate","Caffeine","Sulfites","Artificial sweeteners","Tomatoes","Peaches",
"Plums","Statins","Aspirin", "Chia seeds","Quinoa","Sesame oil","Tapioca","Spirulina",
"Kombucha","Camphor","Buckwheat","Sulfur dioxide","Annatto","Rosemary",
"Monosodium glutamate (MSG)"];

echo "generating allergies\n";
for($i = 0; $i <1000; $i++){
    $allergy[$i]["patientId"] = $patient[$i]["patientId"];
    $allergy[$i]["allergyDesc"] = $allergyTypes[rand(0, 49)];
}

/*
for($j = 1000; $j < 3000; $j++){
        $allergy[$j]["patientId"] = $allergy[rand(0, 999)]["patientId"];
        $allergy[$j]["allergyDesc"] = $allergyTypes[rand(0, 49)];          
}
*/

echo "done allergy\n";
print_r($allergy);

//generating 30 vaccines
$vaccine = array();

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

for($i = 0; $i <30; $i++){
    $vaccine[$i]["scientificName"] = $scientName[$i];
    $vaccine[$i]["disease"] = $disease[$i];
    $vaccine[$i]["noDoses"] = $faker->numberBetween(1, 5);
}
echo "done vaccines\n";
print_r($vaccine);

//generating lots
$lot = array();

echo "generating lots";
for($i = 0; $i <30; $i++){
    $lot[$i]["scientificName"] = $vaccine[$i]["scientificName"];
    $lot[$i]["lotNumber"] = $faker->randomNumber(7, true);
    $key = rand(3, 20);
    for($j = 0; $j < $key; $j++){  
        $lot[$i]["manufacturerPlace"] = $faker->company();
        $lot[$i]["expiration"] = $faker->date('Ymd', '+25 years');
    }
    
}
echo "done lot\n";
print_r($lot);

//generating vaccination sites
$vaccinationSite = array();

echo "generating vac sites\n";
for($i = 0; $i <100; $i++){
    $vaccinationSite[$i]["siteName"] = $faker->unique()->company();
    $vaccinationSite[$i]["addrStreet"] = $faker->streetName();
    $vaccinationSite[$i]["addrCity"] = $faker->city();
    $vaccinationSite[$i]["addrState"] = $faker->stateAbbr();
    $vaccinationSite[$i]["addrZip"] = $faker->postcode();
}
echo "done sites\n";
print_r($vaccinationSite);

//generating 15000 instances of takes
$takes = array();

echo "generating takes\n";
for($i = 0; $i <5000; $i++){
    $takes[$i]["patientId"] = $patient[$i]["patientId"];
    $takes[$i]["siteName"] = $vaccinationSite[rand(0, 99)]["siteName"];
    $takes[$i]["scientificName"] = $vaccine[rand(0, 29)]["scientificName"];
    $takes[$i]["dateTaken"] = $faker->date('Ymd', '-1 year');
}

for($j = 5000; $j <15000; $j++){
    $takes[$j]["patientId"] = $patient[rand(0, 4999)]["patientId"];
    $takes[$j]["siteName"] = $vaccinationSite[rand(0, 99)]["siteName"];
    $takes[$j]["scientificName"] = $vaccine[rand(0, 29)]["scientificName"];
    $takes[$j]["dateTaken"] = $faker->date('Ymd', '-1 year');
}

echo "done takes\n";
print_r($takes);

//generating billing
$billing = array();

echo "generating billing\n";
for($i = 0; $i < count($uninsured_patient); $i++){
    $billing[$i]["patientId"] = $uninsured_patient[$i]["patientId"];
    for($j = 0; $j < count($takes); $j++){
        if($uninsured_patient[$i]["patientId"] == $takes[$j]["patientId"]){
            $billing[$i]["siteName"] = $takes[$j]["siteName"];
        }
    }
}

 
echo "done billing\n";
print_r($billing);


echo "Creating associative array";
$allData = array(
    "patient" => $patient,
    "uninsured_patient" => $uninsured_patient,
    "insured_patient" => $insured_patient,
    "allergy" => $allergy,
    "vaccine" => $vaccine,
    "lot" => $lot,
    "vaccinationSite" => $vaccinationSite,
    "takes" => $takes,
    "billing" => $billing
);
echo "Done\n";


// create new json file
echo "Creating dump.json..";
$fp = fopen("dump.json", "w");
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