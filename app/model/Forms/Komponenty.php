<?php

echo '<center><h1>Formulář pro zadání bazarového produktu na eshop</h1>';

class Komponenty extends Nette\Application\UI\Form {

    public function __construct($parent, $name) {
        parent::__construct();
        $this->setAction($parent->link('Komponenty:success'));

        $this->setMethod("POST");

        $this->addText('Nazev_Komponentu', 'Název komponenty')
                ->setRequired('Prosíme, zapište název komponenty');

        $this->addText('Seriove_Cislo_Komponenta', 'Sériové číslo komponenty')
                ->setRequired('Prosíme, zapište sériové číslo komponenty');

        $this->addText('Pocet_Kusu_Skladem', 'Počet kusů SKLADEM')->setRequired('Napište počet kusů')
                ->addRule(\Nette\Forms\Form::INTEGER, 'Zapište počet kusů pouze čísly');

        $this->addText('Pocet_Kusu_NC', 'Počet kusů NA CESTĚ')->setRequired('Napište počet kusů')
                ->addRule(\Nette\Forms\Form::INTEGER, 'Zapište počet kusů pouze čísly');

        $this->addSelect('Pobocky_SKLADEM', 'Vyberte pobočky ve kterých bude produkt skladem', array('all' => 'Ve všech pobočkách a skladech', 'pobocky' => 'pouze pobočky', 'sklady' => 'pouze sklady', 'poPRAHA' => 'pobočka Praha 20', 'poPLZEN' => 'pobočka Plzeň', 'poBRNO' => 'pobočka Brno', 'vyrobce-dodavatel' => 'na žádost u dodavatele'));

        $this->addRadioList('Typ_Komponenty', 'Typ komponentu', array('RAM' => 'paměť RAM', 'HDD' => 'HDD', 'SSD' => 'SSD', 'GPU' => 'Grafická karta', 'CPU' => 'Procesor', 'MB' => 'Základní deska', 'ostatni' => 'Ostatní'))
                ->setRequired('Je nutné vybrat kategorii do které zapadá zadaný produkt');

        $this->addCheckboxList('Doprava', 'Vyberte způsoby dopravy, jakými může být produkt doručen', array('Osobne' => 'Osobní odběr', 'PostaDR' => 'Česká Pošta - balík do ruky', 'PostaNP' => 'Česká Pošta - balík na poštu', 'Zasilkovna' => 'Zásilkovna', 'DopravaPPL' => 'dopravce PPL', 'dopravceGEIS' => 'dopravce GEIS'))
                ->setRequired('Je nutné vybrat způsob a možnosti dopravy');

        $this->addRadioList('Funkcnost', 'Komponenta funguje?', array('ANO' => 'Ano, funguje', 'NE' => 'Ne, nefunguje', 'Stav_NE' => 'Stav zařízení nelze určit'))
                ->setRequired('Je nutné vybrat stav komponenty.');

        $this->addTextArea('Detaily_Funkcnost', 'Upřesnění stavu produktu [FUNKČNOST]', 40, 3)
                ->setValue('V případě, že zařízení se nechová správně, vypište jej zde, dle výběru nahoře.');
        
        $this->addSelect('Stav_obalu', 'Stav obalu / krabice', array('nove' => 'Nové, nerozbaleno', 'rozbaleno' => 'Pouze rozbaleno', 'rozbaleno_pouzito' => 'Rozbalené a použité', 'pouzito_zanovni' => 'Použité či zánovní'))
                ->setRequired('Je nutné vybrat stav obalu / krabice');  

        $this->addRadioList('Vek', 'Stáří produktu', array('nove' => '2020 - 2015', 'stare' => '2014 - 2010', 'starsi' => '2009 - 2000'))
                ->setRequired('Je nutné vybrat věk / staří produktu.');

        $this->addTextArea('Detaily_Vek', 'Upřesnění produktu (volitelné) [VĚK]', 40, 2)
                ->setValue('V případě,že stav nelze nijak určit.');

        $this->addUpload('Foto', 'Nahrajte fotografii produktu (volitelné)');

        $this->addTextArea('Detaily', 'Upřesnění produktu (volitelné)', 40, 6)
                ->setValue('Zařízení popište detailněji, označení, název, poškození atp...');

        $this->addText('Jmeno_Zadavatele', 'Vaše uživatelské jméno / zadavatele')
                ->setRequired('Prosíme, napište Vaše celé uživatelské jméno')
                ->setValue('nápověda: xPavelNovak');

        $this->addEmail('email', 'Emailová adresa zadavatele produktu')
                ->setRequired(TRUE)
                ->setValue('napověda: xpnovak@eshop.cz')
                ->addRule(\Nette\Forms\Form::EMAIL, 'Tato adresa není platná');

        $this->addPassword('Heslo', 'Vaše heslo pro úpravu')
                ->setRequired(TRUE)
                ->addRule(\Nette\Forms\Form::MIN_LENGTH, 'Více než 6 znaků', 6);

        $this->addPassword('Heslo2', 'Vaše heslo znovu')
                ->setRequired(TRUE)
                ->addRule(\Nette\Forms\Form::EQUAL, 'Heslo nesouhlasí', $this['Heslo']);

        $this->addCheckbox('Souhlas', 'Potvrzuji spravnost zadaného produktu do systému.')
                ->setRequired('Je nutné potvrdit souhlasem !!!');

        $this->addSubmit('Odeslat_Formular', 'Odeslat');
    }

}
