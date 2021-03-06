<?php
// recupero il contenuto inviato da Telegram
$content = file_get_contents("php://input");
// converto il contenuto da JSON ad array PHP
$update = json_decode($content, true);
// se la richiesta è null interrompo lo script
if(!$update)
{
  exit;
}
// assegno alle seguenti variabili il contenuto ricevuto da Telegram
$message = isset($update['message']) ? $update['message'] : "";
$messageId = isset($message['message_id']) ? $message['message_id'] : "";
$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
$date = isset($message['date']) ? $message['date'] : "";
$text = isset($message['text']) ? $message['text'] : "";
// pulisco il messaggio ricevuto togliendo eventuali spazi prima e dopo il testo
$text = trim($text);
// converto tutti i caratteri alfanumerici del messaggio in minuscolo
$text = strtolower($text);
// mi preparo a restitutire al chiamante la mia risposta che è un oggetto JSON
// imposto l'header della risposta
header("Content-Type: application/json");
// la mia risposta è un array JSON composto da chat_id, text, method
// chat_id mi consente di rispondere allo specifico utente che ha scritto al bot
// text è il testo della risposta

$nothing = false;

if(strpos($text, "/start") === 0 || $text=="ciao")
{
	$response = "Ciao $firstname, benvenuto!";
}
elseif($text=="/buzz")
{
	$response = "Tzzzzzz";
}
elseif($text == "/bari")
{
	$frasi = array(
   "C c ne sacciu io",
   "V d c t n v v, cu sto bastn!",
   "Peggio in peggio",
   "Le canestrell",
   "Orecchiette con le anglt",
   "Ehhhh, manco avessi detto 20 minuti",
   "Io il pesce non lo mangio, lo schifo!",
   "L'anglt, lu pesc",
   "Le gambe non funzioooooooo!",
   "Nn timbreshc!",
   "La brace accesa",
   "E non è una bella cousa!",
   "T'agg ricr Nunzia",
   "Che è ancora più meglio di",
   "Patate, riso e CoCo",
   "Il panzeresce",
  );
  $response = $frasi[array_rand($frasi)];
}
elseif(strpos($text, "/insulta")===0)
{
	$loser = ucfirst(trim(str_replace("/insulta", "", $text)));
	$insulti = array(
	 "$loser hai fatto una verdianata?!",
	 "$loser è inutile che fai finta di lavorare!",
	 "$loser non tamburellare!",
	 "$loser fai poco la furba!",
	 "Mael fai schifo!",
	 "$loser ti spacco il pc!",
	 "$loser sei brutto come la fame!",
	 "$loser puzzi!",
	 "Mena $loser, vedi di muoverti!",
     "$loser sei peggio della singroa di nreo vtesita"
  );
	$response = $insulti[array_rand($insulti)];
}
elseif($text == "/disp")
{
	$frasi = array(
        "Garzie",
        "help! paradisi fisclai",
        "GRAZIE Mael, buona giornata",
        "ci dato un occhio",
        "arre publiche",
        "rihìghe :)",
        "...o un incipit diverso che atitri un pò",
        "Non ci capisco più nulla...",
        "abbaiamo",
        "protoshoppare",
        "che ne penate?",
        "scusa, chi è scappato?",
        "CIAO MAEL, GRAZIE",
        "dobbaimo capire che dirli",
        "io non mica so a che punto siamo...",
        "PUBBLICAZIONE DOCUMETENTAZIONE",
        "paola.vedrame@archibuzz.com",
        "vi ho girato un ivirto a mdoificare",
        "risposta a queat...",
        "Io non so nulla...",
        "Alla riunione non ci sarò",
        "Fai tu, è tutto prioritario",
        "Non fumiamoci le mail",
        "Bla bla bla...",
        "facciamo il punto",
        "chiedi a Roby che sa",
        "Caio Male",
        "oggi pomeoggio"
    );
    $response = $frasi[array_rand($frasi)];
}
elseif($text == "/chanty")
{
	$frasi = array(
       "graaaaaaaande",
        "noooo è già lui!?!?",
        "cellu",
        "ci lavoriamo ASAP",
        "totale!",
        "ehilààà",
        "spettacoloooooooooooo"
    );
    $response = $frasi[array_rand($frasi)];
}
else {
  $nothing = true;
}

if (!$nothing) {
  $parameters = array('chat_id' => $chatId, "text" => $response);
  // method è il metodo per l'invio di un messaggio (cfr. API di Telegram)
  $parameters["method"] = "sendMessage";
  // converto e stampo l'array JSON sulla response
  echo json_encode($parameters);
}
