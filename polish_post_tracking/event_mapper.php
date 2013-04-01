<?php

namespace PolishPostTracking;

/**
 * Map event code to description
 */
class EventMapper {

	/**
	 * Mapping array between event code and it's description in Polish language
	 *
	 * @var array
	 */
	public static $events = array(
		'P_A'       =>  'Awizo',
		'P_DKAOK'   =>  'Dodanie do ks. awiz - oczekiwanie na odbiór w Urzędzie (korekta)',
		'P_DKAO'    =>  'Dodanie do księgi awizacyjnej - oczekiwanie na odbiór w Urzędzie',
		'P_D'       =>  'Doręczenie',
		'P_NAD'     =>  'Nadanie',
		'D'         =>  'Nadawca został powiadomiony, oczekuje się na odpowiedź',
		'P_ND'      =>  'Nieudane doręczenie',
		'P_NDZ'     =>  'Nieudane doręczenie - decyzja o zwrocie',
		'P_NDZK'    =>  'Nieudane doręczenie - decyzja o zwrocie - korekta rezultatu',
		'P_NDPD'    =>  'Nieudane doręczenie - kolejna próba dziś',
		'P_NDPJ'    =>  'Nieudane doręczenie - kolejna próba jutro',
		'P_R'       =>  'Nieudane doręczenie - przechowywanie na życzenie',
		'P_NDZAP'   =>  'Nieudane doręczenie - zatrzymana - adresat powiadomiony',
		'P_NDZKON'  =>  'Nieudane doręczenie - zatrzymana - do kontroli',
		'P_OWU'     =>  'Odebranie w urzędzie',
		'P_OWUK'    =>  'Odebranie w urzędzie (korekta rezultatu)',
		'P_OWUWPP'  =>  'Odebranie w urzędzie wymiany (poczta przychodząca)',
		'P_OWUWPW'  =>  'Odebranie w urzędzie wymiany (poczta wychodząca)',
		'P_PA'      =>  'Ponowne awizo',
		'P_POWE'    =>  'Powiadomienie email o oczekiwaniu przesyłki w urzędzie',
		'P_POOE'    =>  'Powiadomienie email o odebraniu przesyłki',
		'P_POZE'    =>  'Powiadomienie email o zwrocie przesyłki',
		'P_POWS'    =>  'Powiadomienie sms o oczekiwaniu przesyłki w urzędzie',
		'P_POOS'    =>  'Powiadomienie sms o odebraniu przesyłki',
		'P_POZS'    =>  'Powiadomienie sms o zwrocie przesyłki',
		'P_S'       =>  'Pozostawienie w skrytce',
		'A'         =>  'Próba doręczenia dokonana dzisiaj',
		'B'         =>  'Próba doręczenia zostanie wykonana następnego dnia roboczego',
		'P_PCWY'    =>  'Przekazanie do cła - wywóz',
		'G'         =>  'Przesyłka zatrzymana do kontroli',
		'C'         =>  'Przesyłka zatrzymana, powiadomienie adresata w toku',
		'E'         =>  'Przesyłka zwrócona do nadawcy',
		'P_PCP'     =>  'Przyjęcie na cle - przywóz',
		'P_WEOC'    =>  'Przyjęcie przesyłki w kraju przeznaczenia',
		'P_WEPL'    =>  'Przyjęcie przesyłki w Polsce',
		'P_WDUNP'   =>  'Przyjęcie w urzędzie przesyłek niedoręczalnych',
		'P_PZL'     =>  'Przyjęcie z ładunkiem',
		'P_REJ'     =>  'Rejestracja przesyłki',
		'P_RUD'     =>  'Rejestracja w urzędzie doręczenia',
		'P_SDUNPK'  =>  'Skierowanie do urzędu niedoręczalnych przesyłek (korekta rez.)',
		'P_SCP'     =>  'Skierowanie przez cło - przywóz',
		'P_WD'      =>  'Wydanie doręczycielowi',
		'P_WUPD'    =>  'Wydanie uprawnionemu do odbioru',
		'P_Z'       =>  'Wyjazd z Urzędu',
		'P_WYOC'    =>  'Wysłanie przesyłki z kraju nadania',
		'P_WYPL'    =>  'Wysłanie przesyłki z Polski',
		'P_WSMS'    =>  'Wysłanie SMS dla przesyłki',
		'P_WZL'   	=>  'Wysłanie z ładunkiem',
		'P_ZPUCPP'  =>  'Zatrzymanie przez urząd celny (poczta przychodząca)',
		'P_ZPUCWKP' =>  'Zatrzymanie przez urząd celny w kraju przeznaczenia',
		'P_ZWC'     =>  'Zatrzymanie w cle',
		'P_ZWMC'    =>  'Zatrzymanie w magazynie celnym',
		'P_WPUCPP'  =>  'Zwolnienie przez urząd celny (poczta przychodząca)',
		'P_WPUCWKP' =>  'Zwolnienie przez urząd celny w kraju przeznaczenia',
		'P_CZDKN'   =>  'Zwrot do kraju nadania',
		'P_ZDUN'   	=>  'Zwrot do urzędu nadania',
		'P_ZZC'   	=>  'Zwrot z cła'
	);

	/**
	 * Map event code to description
	 *
	 * @param 	$_eventCode
	 * @return 	bool|string
	 */
	public static function mapCode( $_eventCode ) {

		if( array_key_exists( $_eventCode, self::$events ) ) {
			return self::$events[ $_eventCode ];
		} else {
			return false;
		}

	}

	/**
	 * Apply by reference mapping of event code to check package response
	 *
	 * @param $_data
	 */
	public static function applyMappingToCheckPackage( & $_data ) {

		foreach( $_data->danePrzesylki->zdarzenia->zdarzenie as $Event ) {
			$mapping = self::mapCode( $Event->kod );
			$Event->opisZdarzenia = $mapping;
		}
	}
}