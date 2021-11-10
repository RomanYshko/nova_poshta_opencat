<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

class NovaPoshta
{
    public $key_api = NULL;
    public $description_field = NULL;
    public $error = array();
    private $api_url = "https://api.novaposhta.ua/v2.0/json/";
    private $settings = NULL;
    private $registry = NULL;
    public function __construct($d2526ec97f8ecdee2da58a3e10a8c17a)
    {
        $this->registry = $d2526ec97f8ecdee2da58a3e10a8c17a;
        if (version_compare(VERSION, "3", ">=")) {
            $this->settings = $this->config->get("shipping_novaposhta");
        } else {
            $this->settings = $this->config->get("novaposhta");
        }
        $this->key_api = isset($this->settings["key_api"]) ? $this->settings["key_api"] : "";
        switch ($this->language->get("code")) {
            case "ru":
            case "ru-ru":
                $this->description_field = "DescriptionRu";
                break;
            default:
                $this->description_field = "Description";
                break;
        }
    }
    public function __get($B1397ea8e9cf545237d6347ef15c9aff)
    {
        return $this->registry->get($B1397ea8e9cf545237d6347ef15c9aff);
    }
    public function apiRequest($a6ba9fb293cf9d7ff6648ca3fa78783e, $c51627100c8337f31377cd06bc553953, $a90cfdbef046afd4b81d84103ad6c989 = array())
    {
        $ceb9d8b6987aaf6e732db6b95e54a56e = array("apiKey" => $this->key_api, "modelName" => $a6ba9fb293cf9d7ff6648ca3fa78783e, "calledMethod" => $c51627100c8337f31377cd06bc553953);
        if (!empty($a90cfdbef046afd4b81d84103ad6c989)) {
            $ceb9d8b6987aaf6e732db6b95e54a56e["methodProperties"] = $a90cfdbef046afd4b81d84103ad6c989;
        }
        $ade8ab746a1551e66caedb8c99fc09e9 = json_encode($ceb9d8b6987aaf6e732db6b95e54a56e);
        $C07e41f4d2fb35855335e2938c714c12 = array(CURLOPT_HTTPHEADER => array("Content-Type: application/json"), CURLOPT_HEADER => false, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false, CURLOPT_POST => true, CURLOPT_POSTFIELDS => $ade8ab746a1551e66caedb8c99fc09e9, CURLOPT_RETURNTRANSFER => true);
        if ($this->settings["curl_connecttimeout"]) {
            $C07e41f4d2fb35855335e2938c714c12[CURLOPT_CONNECTTIMEOUT] = $this->settings["curl_connecttimeout"];
        }
        if ($this->settings["curl_timeout"] && $this->settings["curl_connecttimeout"] < $this->settings["curl_timeout"]) {
            $C07e41f4d2fb35855335e2938c714c12[CURLOPT_TIMEOUT] = $this->settings["curl_timeout"];
        }
        $f9a53fe2cc9cd1dcdcc8308a03deef45 = curl_init($this->api_url);
        curl_setopt_array($f9a53fe2cc9cd1dcdcc8308a03deef45, $C07e41f4d2fb35855335e2938c714c12);
        $C994e9980488b87692c9926153757a0d = curl_exec($f9a53fe2cc9cd1dcdcc8308a03deef45);
        if ($this->settings["debugging_mode"]) {
            $this->log->write("Nova Poshta API request: " . $ade8ab746a1551e66caedb8c99fc09e9);
            $this->log->write("Nova Poshta API response: " . $C994e9980488b87692c9926153757a0d);
            if ($C994e9980488b87692c9926153757a0d === false) {
                $this->log->write("cURL error: " . curl_error($f9a53fe2cc9cd1dcdcc8308a03deef45));
            }
        }
        curl_close($f9a53fe2cc9cd1dcdcc8308a03deef45);
        $C994e9980488b87692c9926153757a0d = json_decode($C994e9980488b87692c9926153757a0d, true);
        $this->parseErrors($C994e9980488b87692c9926153757a0d);
        if (isset($C994e9980488b87692c9926153757a0d["success"]) && isset($C994e9980488b87692c9926153757a0d["data"]) && $C994e9980488b87692c9926153757a0d["success"]) {
            $f2a58451c087527a94a6a79b864c2332 = $C994e9980488b87692c9926153757a0d["data"];
        } else {
            $f2a58451c087527a94a6a79b864c2332 = false;
        }
        return $f2a58451c087527a94a6a79b864c2332;
    }
    private function parseErrors($C994e9980488b87692c9926153757a0d)
    {
        $F37990aff90c455968a32c59eef2c511 = array("errorCodes" => "errors", "warningCodes" => "warnings", "infoCodes" => "info");
        if (!(empty($C994e9980488b87692c9926153757a0d["errorCodes"]) && empty($C994e9980488b87692c9926153757a0d["warningCodes"]) && empty($C994e9980488b87692c9926153757a0d["infoCodes"]))) {
            $f7c2ef530ff921a66428e6635d15b731 = $this->getReferences("errors");
            if (!is_array($f7c2ef530ff921a66428e6635d15b731)) {
                $f7c2ef530ff921a66428e6635d15b731 = array();
            }
        }
        foreach ($F37990aff90c455968a32c59eef2c511 as $fe9c50a4bbd6a8efaf2f811daedc7761 => $Bd66d56c1df4726e3ed1a1f609f40e7d) {
            if (!empty($C994e9980488b87692c9926153757a0d[$Bd66d56c1df4726e3ed1a1f609f40e7d]) && is_array($C994e9980488b87692c9926153757a0d[$Bd66d56c1df4726e3ed1a1f609f40e7d])) {
                foreach ($C994e9980488b87692c9926153757a0d[$Bd66d56c1df4726e3ed1a1f609f40e7d] as $c7a8c2342d0465b628e10bcf97d8d5f2 => $F2d689432bdb5142d98aa4d625e38bc7) {
                    if (is_array($F2d689432bdb5142d98aa4d625e38bc7)) {
                        foreach ($F2d689432bdb5142d98aa4d625e38bc7 as $B7da351f8b28a831c1a196a2c8536a8f => $ef4ef701912698dac98a7aeab793752a) {
                            if (isset($C994e9980488b87692c9926153757a0d[$fe9c50a4bbd6a8efaf2f811daedc7761][$c7a8c2342d0465b628e10bcf97d8d5f2][$B7da351f8b28a831c1a196a2c8536a8f]) && array_key_exists($C994e9980488b87692c9926153757a0d[$fe9c50a4bbd6a8efaf2f811daedc7761][$c7a8c2342d0465b628e10bcf97d8d5f2][$B7da351f8b28a831c1a196a2c8536a8f], $f7c2ef530ff921a66428e6635d15b731)) {
                                $D4ec51fa11395a8797035ab1304cb65c = "Nova Poshta " . $Bd66d56c1df4726e3ed1a1f609f40e7d . ": " . $f7c2ef530ff921a66428e6635d15b731[$C994e9980488b87692c9926153757a0d[$fe9c50a4bbd6a8efaf2f811daedc7761][$c7a8c2342d0465b628e10bcf97d8d5f2][$B7da351f8b28a831c1a196a2c8536a8f]]["Description"];
                            } else {
                                $D4ec51fa11395a8797035ab1304cb65c = "Nova Poshta " . $Bd66d56c1df4726e3ed1a1f609f40e7d . ": " . $ef4ef701912698dac98a7aeab793752a;
                            }
                            if ($Bd66d56c1df4726e3ed1a1f609f40e7d != "info") {
                                $this->error[] = $D4ec51fa11395a8797035ab1304cb65c;
                            }
                            if ($this->settings["debugging_mode"]) {
                                $this->log->write($D4ec51fa11395a8797035ab1304cb65c);
                            }
                        }
                    } else {
                        if (isset($C994e9980488b87692c9926153757a0d[$fe9c50a4bbd6a8efaf2f811daedc7761][$c7a8c2342d0465b628e10bcf97d8d5f2]) && isset($f7c2ef530ff921a66428e6635d15b731[$C994e9980488b87692c9926153757a0d[$fe9c50a4bbd6a8efaf2f811daedc7761][$c7a8c2342d0465b628e10bcf97d8d5f2]]) && isset($f7c2ef530ff921a66428e6635d15b731[$C994e9980488b87692c9926153757a0d[$fe9c50a4bbd6a8efaf2f811daedc7761][$c7a8c2342d0465b628e10bcf97d8d5f2]]["Description"])) {
                            $D4ec51fa11395a8797035ab1304cb65c = "Nova Poshta " . $Bd66d56c1df4726e3ed1a1f609f40e7d . ": " . $f7c2ef530ff921a66428e6635d15b731[$C994e9980488b87692c9926153757a0d[$fe9c50a4bbd6a8efaf2f811daedc7761][$c7a8c2342d0465b628e10bcf97d8d5f2]]["Description"];
                        } else {
                            $D4ec51fa11395a8797035ab1304cb65c = "Nova Poshta " . $Bd66d56c1df4726e3ed1a1f609f40e7d . ": " . $F2d689432bdb5142d98aa4d625e38bc7;
                        }
                        if ($Bd66d56c1df4726e3ed1a1f609f40e7d != "info") {
                            $this->error[] = $D4ec51fa11395a8797035ab1304cb65c;
                        }
                        if ($this->settings["debugging_mode"]) {
                            $this->log->write($D4ec51fa11395a8797035ab1304cb65c);
                        }
                    }
                }
            }
        }
    }
    public function update($Bd66d56c1df4726e3ed1a1f609f40e7d)
    {
        $C7f5c87fb483524cdb3d1d919bb92a5f = 0;
        if ($Bd66d56c1df4726e3ed1a1f609f40e7d == "areas") {
            $f2a58451c087527a94a6a79b864c2332 = $this->apiRequest("Address", "getAreas");
            if ($f2a58451c087527a94a6a79b864c2332) {
                foreach ($f2a58451c087527a94a6a79b864c2332 as $c7a8c2342d0465b628e10bcf97d8d5f2 => $a78bcdca9d9cbbd340e59c21511b8ba8) {
                    $f2a58451c087527a94a6a79b864c2332[$a78bcdca9d9cbbd340e59c21511b8ba8["Description"]] = $a78bcdca9d9cbbd340e59c21511b8ba8;
                    unset($f2a58451c087527a94a6a79b864c2332[$c7a8c2342d0465b628e10bcf97d8d5f2]);
                    $C7f5c87fb483524cdb3d1d919bb92a5f++;
                }
                try {
                    $this->db->query("INSERT INTO `" . DB_PREFIX . "novaposhta_references` (`type`, `value`) VALUES ('areas', '" . $this->db->escape(json_encode($f2a58451c087527a94a6a79b864c2332)) . "') ON DUPLICATE KEY UPDATE `value`='" . $this->db->escape(json_encode($f2a58451c087527a94a6a79b864c2332)) . "'");
                } catch (Exception $ef4ef701912698dac98a7aeab793752a) {
                    if ($this->settings["debugging_mode"]) {
                        $this->log->write($ef4ef701912698dac98a7aeab793752a->getMessage());
                    }
                }
            }
        } else {
            if ($Bd66d56c1df4726e3ed1a1f609f40e7d == "cities") {
                $b59ffc6e6f22caf39ce5a3415908d30f = 1;
                while (!($f2a58451c087527a94a6a79b864c2332 = $this->apiRequest("Address", "getCities", array("Page" => $b59ffc6e6f22caf39ce5a3415908d30f, "Limit" => 500)))) {
                }
                if ($b59ffc6e6f22caf39ce5a3415908d30f == 1) {
                    $this->db->query("TRUNCATE TABLE `" . DB_PREFIX . "novaposhta_cities`");
                }
                foreach ($f2a58451c087527a94a6a79b864c2332 as $a78bcdca9d9cbbd340e59c21511b8ba8) {
                    if ($a78bcdca9d9cbbd340e59c21511b8ba8["Description"] || $a78bcdca9d9cbbd340e59c21511b8ba8["DescriptionRu"]) {
                        if (!$a78bcdca9d9cbbd340e59c21511b8ba8["Description"]) {
                            $a78bcdca9d9cbbd340e59c21511b8ba8["Description"] = $a78bcdca9d9cbbd340e59c21511b8ba8["DescriptionRu"];
                        } else {
                            if (!$a78bcdca9d9cbbd340e59c21511b8ba8["DescriptionRu"]) {
                                $a78bcdca9d9cbbd340e59c21511b8ba8["DescriptionRu"] = $a78bcdca9d9cbbd340e59c21511b8ba8["Description"];
                            }
                        }
                        $B77344b2c6a222ad75610611b678d8b6 = "INSERT INTO `" . DB_PREFIX . "novaposhta_cities` (`CityID`, `Ref`, `Description`, `DescriptionRu`, `Area`, `SettlementType`, `SettlementTypeDescription`, `SettlementTypeDescriptionRu`, `Delivery1`, `Delivery2`, `Delivery3`, `Delivery4`, `Delivery5`, `Delivery6`, `Delivery7`, `Conglomerates`, `PreventEntryNewStreetsUser`, `IsBranch`, `SpecialCashCheck`) VALUES (\r\n                        '" . (int) $a78bcdca9d9cbbd340e59c21511b8ba8["CityID"] . "',\r\n                        '" . (string) $a78bcdca9d9cbbd340e59c21511b8ba8["Ref"] . "',\r\n                        '" . $this->db->escape((string) $a78bcdca9d9cbbd340e59c21511b8ba8["Description"]) . "', \r\n\t\t\t\t\t\t'" . $this->db->escape((string) $a78bcdca9d9cbbd340e59c21511b8ba8["DescriptionRu"]) . "', \t\t\t\t\t\t \r\n\t\t\t\t\t\t'" . (string) $a78bcdca9d9cbbd340e59c21511b8ba8["Area"] . "', \r\n\t\t\t\t\t    '" . (string) $a78bcdca9d9cbbd340e59c21511b8ba8["SettlementType"] . "',\r\n\t\t\t\t\t\t'" . (isset($a78bcdca9d9cbbd340e59c21511b8ba8["SettlementTypeDescription"]) ? $this->db->escape((string) $a78bcdca9d9cbbd340e59c21511b8ba8["SettlementTypeDescription"]) : "") . "',\r\n\t\t\t\t\t\t'" . (isset($a78bcdca9d9cbbd340e59c21511b8ba8["SettlementTypeDescriptionRu"]) ? $this->db->escape((string) $a78bcdca9d9cbbd340e59c21511b8ba8["SettlementTypeDescriptionRu"]) : "") . "',\r\n\t\t\t\t\t\t'" . (int) $a78bcdca9d9cbbd340e59c21511b8ba8["Delivery1"] . "', \r\n\t\t\t\t\t\t'" . (int) $a78bcdca9d9cbbd340e59c21511b8ba8["Delivery2"] . "', \r\n\t\t\t\t\t\t'" . (int) $a78bcdca9d9cbbd340e59c21511b8ba8["Delivery3"] . "', \r\n\t\t\t\t\t\t'" . (int) $a78bcdca9d9cbbd340e59c21511b8ba8["Delivery4"] . "', \r\n\t\t\t\t\t\t'" . (int) $a78bcdca9d9cbbd340e59c21511b8ba8["Delivery5"] . "', \r\n\t\t\t\t\t\t'" . (int) $a78bcdca9d9cbbd340e59c21511b8ba8["Delivery6"] . "', \r\n\t\t\t\t\t\t'" . (int) $a78bcdca9d9cbbd340e59c21511b8ba8["Delivery7"] . "',\r\n\t\t\t\t\t\t'" . ($a78bcdca9d9cbbd340e59c21511b8ba8["Conglomerates"] != NULL ? $this->db->escape(json_encode($a78bcdca9d9cbbd340e59c21511b8ba8["Conglomerates"])) : $this->db->escape($a78bcdca9d9cbbd340e59c21511b8ba8["Conglomerates"])) . "', \r\n\t\t\t\t\t\t'" . $this->db->escape((string) $a78bcdca9d9cbbd340e59c21511b8ba8["PreventEntryNewStreetsUser"]) . "',\r\n\t\t\t\t\t\t'" . (int) $a78bcdca9d9cbbd340e59c21511b8ba8["IsBranch"] . "', \r\n\t\t\t\t\t\t'" . (int) $a78bcdca9d9cbbd340e59c21511b8ba8["SpecialCashCheck"] . "'\r\n\t\t\t\t\t)";
                        try {
                            $this->db->query($B77344b2c6a222ad75610611b678d8b6);
                            $C7f5c87fb483524cdb3d1d919bb92a5f++;
                        } catch (Exception $ef4ef701912698dac98a7aeab793752a) {
                            if ($this->settings["debugging_mode"]) {
                                $this->log->write($ef4ef701912698dac98a7aeab793752a->getMessage());
                            }
                        }
                    }
                }
                $b59ffc6e6f22caf39ce5a3415908d30f++;
            } else {
                if ($Bd66d56c1df4726e3ed1a1f609f40e7d == "warehouses") {
                    $b59ffc6e6f22caf39ce5a3415908d30f = 1;
                    while (!($f2a58451c087527a94a6a79b864c2332 = $this->apiRequest("Address", "getWarehouses", array("Page" => $b59ffc6e6f22caf39ce5a3415908d30f, "Limit" => 500)))) {
                    }
                    if ($b59ffc6e6f22caf39ce5a3415908d30f == 1) {
                        $this->db->query("TRUNCATE TABLE `" . DB_PREFIX . "novaposhta_warehouses`");
                    }
                    foreach ($f2a58451c087527a94a6a79b864c2332 as $a78bcdca9d9cbbd340e59c21511b8ba8) {
                        if ($a78bcdca9d9cbbd340e59c21511b8ba8["Description"] || $a78bcdca9d9cbbd340e59c21511b8ba8["DescriptionRu"]) {
                            if (!$a78bcdca9d9cbbd340e59c21511b8ba8["Description"]) {
                                $a78bcdca9d9cbbd340e59c21511b8ba8["Description"] = $a78bcdca9d9cbbd340e59c21511b8ba8["DescriptionRu"];
                            } else {
                                if (!$a78bcdca9d9cbbd340e59c21511b8ba8["DescriptionRu"]) {
                                    $a78bcdca9d9cbbd340e59c21511b8ba8["DescriptionRu"] = $a78bcdca9d9cbbd340e59c21511b8ba8["Description"];
                                }
                            }
                            $fc53d4366a92d996505f62a9f3e85956 = preg_replace(array("/\"([^\"]*)\"/", "/\"/"), array("«\$1»", ""), $a78bcdca9d9cbbd340e59c21511b8ba8["Description"]);
                            $F82e60b8b751358bde1bf6c352f2bc56 = preg_replace(array("/\"([^\"]*)\"/", "/\"/"), array("«\$1»", ""), $a78bcdca9d9cbbd340e59c21511b8ba8["DescriptionRu"]);
                            $B77344b2c6a222ad75610611b678d8b6 = "INSERT INTO `" . DB_PREFIX . "novaposhta_warehouses` (`SiteKey`, `Ref`, `Description`, `DescriptionRu`, `ShortAddress`, `ShortAddressRu`, `TypeOfWarehouse`, `CityRef`, `CityDescription`, `CityDescriptionRu`, `Number`, `Phone`,  `Longitude`, `Latitude`, `PostFinance`, `BicycleParking`, `PaymentAccess`, `POSTerminal`, `InternationalShipping`, `TotalMaxWeightAllowed`, `PlaceMaxWeightAllowed`, `Reception`, `Delivery`, `Schedule`, `DistrictCode`, `WarehouseStatus`, `CategoryOfWarehouse`) VALUES (\r\n                        '" . (int) $a78bcdca9d9cbbd340e59c21511b8ba8["SiteKey"] . "',\r\n                        '" . (string) $a78bcdca9d9cbbd340e59c21511b8ba8["Ref"] . "',\r\n\t\t\t\t\t\t'" . $this->db->escape((string) $fc53d4366a92d996505f62a9f3e85956) . "',\r\n\t\t\t\t\t\t'" . $this->db->escape((string) $F82e60b8b751358bde1bf6c352f2bc56) . "',\r\n\t\t\t\t\t\t'" . $this->db->escape((string) $a78bcdca9d9cbbd340e59c21511b8ba8["ShortAddress"]) . "',\r\n\t\t\t\t\t\t'" . $this->db->escape((string) $a78bcdca9d9cbbd340e59c21511b8ba8["ShortAddressRu"]) . "',\r\n\t\t\t\t\t\t'" . (string) $a78bcdca9d9cbbd340e59c21511b8ba8["TypeOfWarehouse"] . "',\r\n\t\t\t\t\t\t'" . (string) $a78bcdca9d9cbbd340e59c21511b8ba8["CityRef"] . "',\r\n\t\t\t\t\t\t'" . $this->db->escape((string) $a78bcdca9d9cbbd340e59c21511b8ba8["CityDescription"]) . "',\r\n\t\t\t\t\t\t'" . $this->db->escape((string) $a78bcdca9d9cbbd340e59c21511b8ba8["CityDescriptionRu"]) . "',\r\n\t\t\t\t\t\t'" . (int) $a78bcdca9d9cbbd340e59c21511b8ba8["Number"] . "',\r\n\t\t\t\t\t\t'" . $this->db->escape((string) $a78bcdca9d9cbbd340e59c21511b8ba8["Phone"]) . "',\r\n\t\t\t\t\t\t'" . (int) $a78bcdca9d9cbbd340e59c21511b8ba8["Longitude"] . "', \r\n\t\t\t\t\t\t'" . (int) $a78bcdca9d9cbbd340e59c21511b8ba8["Latitude"] . "',\r\n\t\t\t\t\t\t'" . (int) $a78bcdca9d9cbbd340e59c21511b8ba8["PostFinance"] . "', \r\n\t\t\t\t\t\t'" . (int) $a78bcdca9d9cbbd340e59c21511b8ba8["BicycleParking"] . "', \r\n\t\t\t\t\t\t'" . (int) $a78bcdca9d9cbbd340e59c21511b8ba8["PaymentAccess"] . "', \r\n\t\t\t\t\t\t'" . (int) $a78bcdca9d9cbbd340e59c21511b8ba8["POSTerminal"] . "', \r\n\t\t\t\t\t\t'" . (int) $a78bcdca9d9cbbd340e59c21511b8ba8["InternationalShipping"] . "', \r\n\t\t\t\t\t\t'" . (int) $a78bcdca9d9cbbd340e59c21511b8ba8["TotalMaxWeightAllowed"] . "', \r\n\t\t\t\t\t\t'" . (int) $a78bcdca9d9cbbd340e59c21511b8ba8["PlaceMaxWeightAllowed"] . "', \r\n\t\t\t\t\t\t'" . $this->db->escape(json_encode($a78bcdca9d9cbbd340e59c21511b8ba8["Reception"])) . "', \r\n\t\t\t\t\t\t'" . $this->db->escape(json_encode($a78bcdca9d9cbbd340e59c21511b8ba8["Delivery"])) . "', \r\n\t\t\t\t\t\t'" . $this->db->escape(json_encode($a78bcdca9d9cbbd340e59c21511b8ba8["Schedule"])) . "',\r\n\t\t\t\t\t\t'" . $this->db->escape((string) $a78bcdca9d9cbbd340e59c21511b8ba8["DistrictCode"]) . "',\r\n\t\t\t\t\t\t'" . $this->db->escape((string) $a78bcdca9d9cbbd340e59c21511b8ba8["WarehouseStatus"]) . "',\r\n\t\t\t\t\t\t'" . $this->db->escape((string) $a78bcdca9d9cbbd340e59c21511b8ba8["CategoryOfWarehouse"]) . "'\r\n\t\t\t\t\t)";
                            try {
                                $this->db->query($B77344b2c6a222ad75610611b678d8b6);
                                $C7f5c87fb483524cdb3d1d919bb92a5f++;
                            } catch (Exception $ef4ef701912698dac98a7aeab793752a) {
                                if ($this->settings["debugging_mode"]) {
                                    $this->log->write($ef4ef701912698dac98a7aeab793752a->getMessage());
                                }
                            }
                        }
                    }
                    $b59ffc6e6f22caf39ce5a3415908d30f++;
                } else {
                    if ($Bd66d56c1df4726e3ed1a1f609f40e7d == "references") {
                        $eb0c780b66c87edd1cade1ccb3bdff7e = array("extension" => "novaposhta");
                        $C07e41f4d2fb35855335e2938c714c12 = array(CURLOPT_HEADER => false, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false, CURLOPT_POST => true, CURLOPT_POSTFIELDS => $eb0c780b66c87edd1cade1ccb3bdff7e, CURLOPT_RETURNTRANSFER => true);
                        if ($this->settings["curl_connecttimeout"]) {
                            $C07e41f4d2fb35855335e2938c714c12[CURLOPT_CONNECTTIMEOUT] = $this->settings["curl_connecttimeout"];
                        }
                        if ($this->settings["curl_timeout"] && $this->settings["curl_connecttimeout"] < $this->settings["curl_timeout"]) {
                            $C07e41f4d2fb35855335e2938c714c12[CURLOPT_TIMEOUT] = $this->settings["curl_timeout"];
                        }
                        $f9a53fe2cc9cd1dcdcc8308a03deef45 = curl_init("https://oc-max.com/index.php?route=extension/module/ocmax/getData");
                        curl_setopt_array($f9a53fe2cc9cd1dcdcc8308a03deef45, $C07e41f4d2fb35855335e2938c714c12);
                        $C994e9980488b87692c9926153757a0d = curl_exec($f9a53fe2cc9cd1dcdcc8308a03deef45);
                        curl_close($f9a53fe2cc9cd1dcdcc8308a03deef45);
                        $f2a58451c087527a94a6a79b864c2332 = json_decode($C994e9980488b87692c9926153757a0d, true);
                        $f2a58451c087527a94a6a79b864c2332["senders"] = $this->getCounterparties("Sender");
                        $f2a58451c087527a94a6a79b864c2332["third_persons"] = $this->getCounterparties("ThirdPerson");
                        if ($f2a58451c087527a94a6a79b864c2332["senders"]) {
                            foreach ($f2a58451c087527a94a6a79b864c2332["senders"] as $Ebb2b24ab657cd127faff82b61796781) {
                                $f2a58451c087527a94a6a79b864c2332["sender_options"][$Ebb2b24ab657cd127faff82b61796781["Ref"]] = $this->getCounterpartyOptions($Ebb2b24ab657cd127faff82b61796781["Ref"]);
                                $f2a58451c087527a94a6a79b864c2332["sender_contact_persons"][$Ebb2b24ab657cd127faff82b61796781["Ref"]] = $this->getContactPerson($Ebb2b24ab657cd127faff82b61796781["Ref"]);
                                $f2a58451c087527a94a6a79b864c2332["sender_addresses"][$Ebb2b24ab657cd127faff82b61796781["Ref"]] = $this->getCounterpartyAddresses($Ebb2b24ab657cd127faff82b61796781["Ref"], "Sender");
                            }
                        }
                        $f2a58451c087527a94a6a79b864c2332["warehouse_types"] = $this->apiRequest("Address", "getWarehouseTypes");
                        $f2a58451c087527a94a6a79b864c2332["service_types"] = $this->apiRequest("Common", "getServiceTypes");
                        $f2a58451c087527a94a6a79b864c2332["cargo_types"] = $this->apiRequest("Common", "getCargoTypes");
                        $f2a58451c087527a94a6a79b864c2332["pack_types"] = $this->apiRequest("Common", "getPackList");
                        $f2a58451c087527a94a6a79b864c2332["tires_and_wheels"] = $this->apiRequest("Common", "getTiresWheelsList");
                        $f2a58451c087527a94a6a79b864c2332["payer_types"] = $this->apiRequest("Common", "getTypesOfPayers");
                        $f2a58451c087527a94a6a79b864c2332["payment_types"] = $this->apiRequest("Common", "getPaymentForms");
                        $f2a58451c087527a94a6a79b864c2332["backward_delivery_types"] = $this->apiRequest("Common", "getBackwardDeliveryCargoTypes");
                        $f2a58451c087527a94a6a79b864c2332["backward_delivery_payers"] = $this->apiRequest("Common", "getTypesOfPayersForRedelivery");
                        $f2a58451c087527a94a6a79b864c2332["payment_cards"] = array();
                        $f2a58451c087527a94a6a79b864c2332["cargo_description"] = array_merge($this->apiRequest("Common", "getCargoDescriptionList", array("Page" => 1)), $this->apiRequest("Common", "getCargoDescriptionList", array("Page" => 2)));
                        $f2a58451c087527a94a6a79b864c2332["ownership_forms"] = $this->apiRequest("Common", "getOwnershipFormsList");
                        $f2a58451c087527a94a6a79b864c2332["counterparties_types"] = $this->apiRequest("Common", "getTypesOfCounterparties");
                        $f2a58451c087527a94a6a79b864c2332["errors"] = $this->getErrors();
                        if (0 < count($f2a58451c087527a94a6a79b864c2332, COUNT_RECURSIVE) - count($f2a58451c087527a94a6a79b864c2332)) {
                            foreach ($f2a58451c087527a94a6a79b864c2332 as $c7a8c2342d0465b628e10bcf97d8d5f2 => $a78bcdca9d9cbbd340e59c21511b8ba8) {
                                $this->db->query("INSERT INTO `" . DB_PREFIX . "novaposhta_references` (`type`, `value`) VALUES ('" . $c7a8c2342d0465b628e10bcf97d8d5f2 . "', '" . $this->db->escape(json_encode($a78bcdca9d9cbbd340e59c21511b8ba8)) . "') ON DUPLICATE KEY UPDATE `value`='" . $this->db->escape(json_encode($a78bcdca9d9cbbd340e59c21511b8ba8)) . "'");
                            }
                        }
                        $C7f5c87fb483524cdb3d1d919bb92a5f = count($f2a58451c087527a94a6a79b864c2332);
                    }
                }
            }
        }
        if ($C7f5c87fb483524cdb3d1d919bb92a5f) {
            $b9421a3ebcd4c69cff5c91877f7af0e4 = $this->getReferences("database");
            $b9421a3ebcd4c69cff5c91877f7af0e4[$Bd66d56c1df4726e3ed1a1f609f40e7d]["update_datetime"] = date($this->language->get("datetime_format"));
            $b9421a3ebcd4c69cff5c91877f7af0e4[$Bd66d56c1df4726e3ed1a1f609f40e7d]["amount"] = $C7f5c87fb483524cdb3d1d919bb92a5f;
            $this->db->query("INSERT INTO `" . DB_PREFIX . "novaposhta_references` (`type`, `value`) VALUES ('database', '" . json_encode($b9421a3ebcd4c69cff5c91877f7af0e4) . "') ON DUPLICATE KEY UPDATE `value`='" . json_encode($b9421a3ebcd4c69cff5c91877f7af0e4) . "'");
        }
        return $C7f5c87fb483524cdb3d1d919bb92a5f;
    }
    public function areas()
    {
        return array("АРК" => array("Крим", "АРК", "Крым", "АРК", "Krym", "Crimea"), "Вінницька" => array("Вінниця", "Вінницька", "Винница", "Винницкая", "Vinnitsa", "Vinnitskaya"), "Волинська" => array("Волинь", "Волинська", "Волынь", "Волынская", "Volyn", "Volynskaya"), "Дніпропетровська" => array("Дніпро", "Дніпропетровськ", "Дніпропетровська", "Днепропетровск", "Днепропетровская", "Dnipropetrovsk", "Dnepropetrovskaya"), "Донецька" => array("Донецьк", "Донецька", "Донецк", "Донецкая", "Donetsk", "Donetskaya"), "Житомирська" => array("Житомир", "Житомирська", "Житомир", "Житомирская", "Zhytomyr", "Zhitomirskaya"), "Закарпатська" => array("Закарпаття", "Закарпатська", "Закарпатье", "Закарпатская", "Zakarpattya", "Zakarpatskaya"), "Запорізька" => array("Запоріжжя", "Запорізька", "Запорожье", "Запорожская", "Zaporizhia", "Zaporozhskaya"), "Івано-Франківська" => array("Івано-Франківськ", "Івано-Франківська", "Ивано-Франковск", "Ивано-Франковская", "Ivano-Frankivsk", "Ivano-Frankovskaya"), "Київська" => array("Київ", "Київська", "Киев", "Киевская", "Kyiv", "Kiyevskaya"), "Київ" => array("Київ", "Київська", "Киев", "Киевская", "Kyiv", "Kiyevskaya"), "Кіровоградська" => array("Кіровоград", "Кіровоградська", "Кировоград", "Кировоградская", "Kirovohrad", "Kirovogradskaya"), "Луганська" => array("Луганськ", "Луганська", "Луганск", "Луганская", "Lugansk", "Luganskaya"), "Львівська" => array("Львів", "Львівська", "Львов", "Львовская", "Lviv", "L'vovskaya"), "Миколаївська" => array("Миколаїв", "Миколаївська", "Николаев", "Николаевская", "Mykolaiv", "Nikolayevskaya"), "Одеська" => array("Одеса", "Одеська", "Одесса", "Одесская", "Odessa", "Odesskaya"), "Полтавська" => array("Полтава", "Полтавська", "Полтава", "Полтавская", "Poltava", "Poltavskaya"), "Рівненська" => array("Рівне", "Рівненська", "Ровно", "Ровненская", "Ровенская", "Rivne", "Rovenskaya"), "Сумська" => array("Суми", "Сумська", "Сумы", "Сумская", "Sums", "Sumskaya"), "Тернопільська" => array("Тернопіль", "Тернопільська", "Тернополь", "Тернопольская", "Ternopil", "Ternopol'skaya"), "Харківська" => array("Харків", "Харківська", "Харьков", "Харьковская", "Kharkov", "Khar'kovskaya"), "Херсонська" => array("Херсон", "Херсонська", "Херсон", "Херсонская", "Herson", "Khersonskaya"), "Хмельницька" => array("Хмельницьк", "Хмельницька", "Хмельницкий", "Хмельницкая", "Khmelnytsky", "Khmel'nitskaya"), "Черкаська" => array("Черкаси", "Черкаська", "Черкассы", "Черкасская", "Cherkassy", "Cherkasskaya"), "Чернівецька" => array("Чернівці", "Чернівецька", "Черновцы", "Черновицкая", "Chernivtsi", "Chernovitskaya"), "Чернігівська" => array("Чернігів", "Чернігівська", "Чернигов", "Черниговская", "Chernihiv", "Chernigovskaya"));
    }
    public function getAreaRef($B1397ea8e9cf545237d6347ef15c9aff)
    {
        $f2a58451c087527a94a6a79b864c2332 = "";
        $B5069ba92fdeaf6d1262c2e58be5e9f8 = $this->getAreas();
        $d3af97854f14e925b63b26b16810e0f8 = $this->areas();
        $cdcd983834fcd4fbb7f20d8f348eb7e7 = mb_substr($B1397ea8e9cf545237d6347ef15c9aff, 0, 6, "UTF-8");
        foreach ($d3af97854f14e925b63b26b16810e0f8 as $cb7a7fa6405f2565deb4a42ed64b9f2a => $a78bcdca9d9cbbd340e59c21511b8ba8) {
            $Fe84eb0c1ca52e8a91b8004539e3effd = preg_grep("/^" . preg_quote($cdcd983834fcd4fbb7f20d8f348eb7e7) . "/ui", $a78bcdca9d9cbbd340e59c21511b8ba8);
            if (!empty($Fe84eb0c1ca52e8a91b8004539e3effd)) {
                $f2a58451c087527a94a6a79b864c2332 = $B5069ba92fdeaf6d1262c2e58be5e9f8[$cb7a7fa6405f2565deb4a42ed64b9f2a]["Ref"];
                break;
            }
        }
        return $f2a58451c087527a94a6a79b864c2332;
    }
    public function getZoneIDByName($B1397ea8e9cf545237d6347ef15c9aff)
    {
        $f2a58451c087527a94a6a79b864c2332 = array();
        $ae7891308bd2040216b79e207606e2e8 = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE `country_id` = '" . (int) $this->config->get("config_country_id") . "' AND `status` = '1' ORDER BY `name`")->rows;
        $C0f4f187e85ce8c24a9093a45788f341 = $this->areas();
        $B6eeacfbc6ae0bf157d29349d69ff0d6 = $C0f4f187e85ce8c24a9093a45788f341[$B1397ea8e9cf545237d6347ef15c9aff];
        foreach ($ae7891308bd2040216b79e207606e2e8 as $ec7fa098d92fdefc88cadefe55acd845) {
            $cdcd983834fcd4fbb7f20d8f348eb7e7 = mb_substr($ec7fa098d92fdefc88cadefe55acd845["name"], 0, 6, "UTF-8");
            $Fe84eb0c1ca52e8a91b8004539e3effd = preg_grep("/^" . preg_quote($cdcd983834fcd4fbb7f20d8f348eb7e7) . "/ui", $B6eeacfbc6ae0bf157d29349d69ff0d6);
            if (!empty($Fe84eb0c1ca52e8a91b8004539e3effd)) {
                $f2a58451c087527a94a6a79b864c2332 = $ec7fa098d92fdefc88cadefe55acd845;
                break;
            }
        }
        return !empty($f2a58451c087527a94a6a79b864c2332["zone_id"]) ? $f2a58451c087527a94a6a79b864c2332["zone_id"] : false;
    }
    public function getAreaName($a341e627d70b1dbf3683bef9a6bfc4a5)
    {
        $f2a58451c087527a94a6a79b864c2332 = "";
        $B5069ba92fdeaf6d1262c2e58be5e9f8 = $this->getAreas();
        foreach ($B5069ba92fdeaf6d1262c2e58be5e9f8 as $cb7a7fa6405f2565deb4a42ed64b9f2a => $a78bcdca9d9cbbd340e59c21511b8ba8) {
            if ($a341e627d70b1dbf3683bef9a6bfc4a5 == $a78bcdca9d9cbbd340e59c21511b8ba8["Ref"]) {
                $f2a58451c087527a94a6a79b864c2332 = $cb7a7fa6405f2565deb4a42ed64b9f2a;
                break;
            }
        }
        return $f2a58451c087527a94a6a79b864c2332;
    }
    public function getAreas()
    {
        $f2a58451c087527a94a6a79b864c2332 = $this->getReferences("areas");
        return $f2a58451c087527a94a6a79b864c2332;
    }
    public function getCityArea($a341e627d70b1dbf3683bef9a6bfc4a5)
    {
        $aa8e6db61563eaef430e6ec702f6be93 = $this->db->query("SELECT `Area` FROM `" . DB_PREFIX . "novaposhta_cities` WHERE `Ref` = '" . $this->db->escape($a341e627d70b1dbf3683bef9a6bfc4a5) . "'")->row;
        return $aa8e6db61563eaef430e6ec702f6be93 ? $aa8e6db61563eaef430e6ec702f6be93["Area"] : "";
    }
    public function getCityRef($B1397ea8e9cf545237d6347ef15c9aff)
    {
        $aa8e6db61563eaef430e6ec702f6be93 = $this->db->query("SELECT `Ref` FROM `" . DB_PREFIX . "novaposhta_cities` WHERE `Description` = '" . $this->db->escape($B1397ea8e9cf545237d6347ef15c9aff) . "' OR `DescriptionRu` = '" . $this->db->escape($B1397ea8e9cf545237d6347ef15c9aff) . "'")->row;
        return $aa8e6db61563eaef430e6ec702f6be93 ? $aa8e6db61563eaef430e6ec702f6be93["Ref"] : "";
    }
    public function getCityName($a341e627d70b1dbf3683bef9a6bfc4a5)
    {
        $aa8e6db61563eaef430e6ec702f6be93 = $this->db->query("SELECT `" . $this->description_field . "` FROM `" . DB_PREFIX . "novaposhta_cities` WHERE `Ref` = '" . $this->db->escape($a341e627d70b1dbf3683bef9a6bfc4a5) . "'")->row;
        return $aa8e6db61563eaef430e6ec702f6be93 ? $aa8e6db61563eaef430e6ec702f6be93[$this->description_field] : "";
    }
    public function getCities($c58203fb431f69c4ab61cc7cc3eabdbf = "", $c9a612e195d1cfbefaa6030d1a8cf9e9 = "")
    {
        $f2a58451c087527a94a6a79b864c2332 = array();
        $B77344b2c6a222ad75610611b678d8b6 = "SELECT *, `" . $this->description_field . "` as `Description` FROM `" . DB_PREFIX . "novaposhta_cities` WHERE 1";
        if ($c58203fb431f69c4ab61cc7cc3eabdbf) {
            $B77344b2c6a222ad75610611b678d8b6 .= " AND (`Description` LIKE '" . $this->db->escape($c58203fb431f69c4ab61cc7cc3eabdbf) . "%' OR `DescriptionRu` LIKE '" . $this->db->escape($c58203fb431f69c4ab61cc7cc3eabdbf) . "%')";
        }
        if ($c9a612e195d1cfbefaa6030d1a8cf9e9) {
            $B77344b2c6a222ad75610611b678d8b6 .= " AND `Area` = '" . $this->db->escape($c9a612e195d1cfbefaa6030d1a8cf9e9) . "'";
        }
        $B77344b2c6a222ad75610611b678d8b6 .= " ORDER BY `" . $this->description_field . "` LIMIT 10";
        $Dbd029669c4ac2a513a951ef71683ee8 = $this->db->query($B77344b2c6a222ad75610611b678d8b6)->rows;
        foreach ($Dbd029669c4ac2a513a951ef71683ee8 as $aa8e6db61563eaef430e6ec702f6be93) {
            $f2a58451c087527a94a6a79b864c2332[] = array("Ref" => $aa8e6db61563eaef430e6ec702f6be93["Ref"], "Description" => $aa8e6db61563eaef430e6ec702f6be93[$this->description_field], "FullDescription" => $aa8e6db61563eaef430e6ec702f6be93[$this->description_field] . ", " . $this->novaposhta->getAreaName($aa8e6db61563eaef430e6ec702f6be93["Area"]) . " обл.");
        }
        return $f2a58451c087527a94a6a79b864c2332;
    }
    public function getWarehouseRef($B1397ea8e9cf545237d6347ef15c9aff)
    {
        $Dbd029669c4ac2a513a951ef71683ee8 = $this->db->query("SELECT `Ref` FROM `" . DB_PREFIX . "novaposhta_warehouses` WHERE `Description` = '" . $this->db->escape($B1397ea8e9cf545237d6347ef15c9aff) . "' OR `DescriptionRu` = '" . $this->db->escape($B1397ea8e9cf545237d6347ef15c9aff) . "'")->row;
        return $Dbd029669c4ac2a513a951ef71683ee8 ? $Dbd029669c4ac2a513a951ef71683ee8["Ref"] : "";
    }
    public function getWarehouseName($a341e627d70b1dbf3683bef9a6bfc4a5)
    {
        $Dbd029669c4ac2a513a951ef71683ee8 = $this->db->query("SELECT `" . $this->description_field . "` FROM `" . DB_PREFIX . "novaposhta_warehouses` WHERE `Ref` = '" . $this->db->escape($a341e627d70b1dbf3683bef9a6bfc4a5) . "'")->row;
        return $Dbd029669c4ac2a513a951ef71683ee8 ? $Dbd029669c4ac2a513a951ef71683ee8[$this->description_field] : "";
    }
    public function getWarehouseByCity($A5216392d4c1a45f49aa24b8432acb8f, $f9f6e7b84a1ac6318b949851243ff168)
    {
        $A5216392d4c1a45f49aa24b8432acb8f = $this->db->escape($A5216392d4c1a45f49aa24b8432acb8f);
        $f9f6e7b84a1ac6318b949851243ff168 = $this->db->escape($f9f6e7b84a1ac6318b949851243ff168);
        $aa8e6db61563eaef430e6ec702f6be93 = $this->db->query("SELECT `" . $this->description_field . "` as `Description`, `Ref` FROM `" . DB_PREFIX . "novaposhta_warehouses` WHERE (`Ref` = '" . $A5216392d4c1a45f49aa24b8432acb8f . "' OR `Description` = '" . $A5216392d4c1a45f49aa24b8432acb8f . "' OR `DescriptionRu` = '" . $A5216392d4c1a45f49aa24b8432acb8f . "') AND (`CityRef` = '" . $f9f6e7b84a1ac6318b949851243ff168 . "' OR `CityDescription` = '" . $f9f6e7b84a1ac6318b949851243ff168 . "' OR `CityDescriptionRu` = '" . $f9f6e7b84a1ac6318b949851243ff168 . "')")->row;
        return $aa8e6db61563eaef430e6ec702f6be93;
    }
    public function getWarehousesByCityRef($f7170fe24e55d5cf07fa50847543e861, $c58203fb431f69c4ab61cc7cc3eabdbf = "")
    {
        $B77344b2c6a222ad75610611b678d8b6 = "SELECT *, `" . $this->description_field . "` as `Description`, `Ref` FROM `" . DB_PREFIX . "novaposhta_warehouses` WHERE `CityRef` = '" . $this->db->escape($f7170fe24e55d5cf07fa50847543e861) . "'";
        if ($c58203fb431f69c4ab61cc7cc3eabdbf) {
            $B77344b2c6a222ad75610611b678d8b6 .= " AND (`Description` LIKE '%" . $this->db->escape($c58203fb431f69c4ab61cc7cc3eabdbf) . "%' OR `DescriptionRu` LIKE '%" . $this->db->escape($c58203fb431f69c4ab61cc7cc3eabdbf) . "%')";
        }
        $Dbd029669c4ac2a513a951ef71683ee8 = $this->db->query($B77344b2c6a222ad75610611b678d8b6)->rows;
        return $Dbd029669c4ac2a513a951ef71683ee8;
    }
    public function getWarehousesByCityName($e06b105ed105b824dc3bbfbc509d0910, $c58203fb431f69c4ab61cc7cc3eabdbf = "")
    {
        $e06b105ed105b824dc3bbfbc509d0910 = $this->db->escape($e06b105ed105b824dc3bbfbc509d0910);
        $B77344b2c6a222ad75610611b678d8b6 = "SELECT *, `" . $this->description_field . "` as `Description` FROM `" . DB_PREFIX . "novaposhta_warehouses` WHERE (`CityDescription` = '" . $e06b105ed105b824dc3bbfbc509d0910 . "' OR `CityDescriptionRu` = '" . $e06b105ed105b824dc3bbfbc509d0910 . "')";
        if ($c58203fb431f69c4ab61cc7cc3eabdbf) {
            $B77344b2c6a222ad75610611b678d8b6 .= " AND `" . $this->description_field . "` LIKE '%" . $this->db->escape($c58203fb431f69c4ab61cc7cc3eabdbf) . "%'";
        }
        $Dbd029669c4ac2a513a951ef71683ee8 = $this->db->query($B77344b2c6a222ad75610611b678d8b6)->rows;
        return $Dbd029669c4ac2a513a951ef71683ee8;
    }
    public function searchSettlements($c58203fb431f69c4ab61cc7cc3eabdbf = "", $b9f8c18aa42bdf4a166d53ba59b6520e = 0)
    {
        $f2a58451c087527a94a6a79b864c2332 = array();
        $a90cfdbef046afd4b81d84103ad6c989 = array();
        if ($c58203fb431f69c4ab61cc7cc3eabdbf) {
            $a90cfdbef046afd4b81d84103ad6c989["CityName"] = $c58203fb431f69c4ab61cc7cc3eabdbf;
        }
        if ($b9f8c18aa42bdf4a166d53ba59b6520e) {
            $a90cfdbef046afd4b81d84103ad6c989["Limit"] = $b9f8c18aa42bdf4a166d53ba59b6520e;
        }
        $aa8e6db61563eaef430e6ec702f6be93 = $this->apiRequest("Address", "searchSettlements", $a90cfdbef046afd4b81d84103ad6c989);
        if (!empty($aa8e6db61563eaef430e6ec702f6be93[0]["TotalCount"])) {
            $f2a58451c087527a94a6a79b864c2332 = $aa8e6db61563eaef430e6ec702f6be93[0]["Addresses"];
        }
        return $f2a58451c087527a94a6a79b864c2332;
    }
    public function searchSettlementStreets($F302bdd9b928d457a1d4308e75620a4c, $c58203fb431f69c4ab61cc7cc3eabdbf = "", $b9f8c18aa42bdf4a166d53ba59b6520e = 0)
    {
        $f2a58451c087527a94a6a79b864c2332 = array();
        $a90cfdbef046afd4b81d84103ad6c989 = array("SettlementRef" => $F302bdd9b928d457a1d4308e75620a4c);
        if ($c58203fb431f69c4ab61cc7cc3eabdbf) {
            $a90cfdbef046afd4b81d84103ad6c989["StreetName"] = $c58203fb431f69c4ab61cc7cc3eabdbf;
        }
        if ($b9f8c18aa42bdf4a166d53ba59b6520e) {
            $a90cfdbef046afd4b81d84103ad6c989["Limit"] = $b9f8c18aa42bdf4a166d53ba59b6520e;
        }
        $aa8e6db61563eaef430e6ec702f6be93 = $this->apiRequest("Address", "searchSettlementStreets", $a90cfdbef046afd4b81d84103ad6c989);
        if (!empty($aa8e6db61563eaef430e6ec702f6be93[0]["TotalCount"])) {
            $f2a58451c087527a94a6a79b864c2332 = $aa8e6db61563eaef430e6ec702f6be93[0]["Addresses"];
        }
        return $f2a58451c087527a94a6a79b864c2332;
    }
    public function getReferences($Bd66d56c1df4726e3ed1a1f609f40e7d = "")
    {
        $f2a58451c087527a94a6a79b864c2332 = array();
        if ($Bd66d56c1df4726e3ed1a1f609f40e7d) {
            $aa8e6db61563eaef430e6ec702f6be93 = $this->db->query("SELECT `value` FROM `" . DB_PREFIX . "novaposhta_references` WHERE `type` = '" . $Bd66d56c1df4726e3ed1a1f609f40e7d . "'")->row;
            if (isset($aa8e6db61563eaef430e6ec702f6be93["value"])) {
                $f2a58451c087527a94a6a79b864c2332 = json_decode($aa8e6db61563eaef430e6ec702f6be93["value"], true);
                if (is_array($f2a58451c087527a94a6a79b864c2332)) {
                    foreach ($f2a58451c087527a94a6a79b864c2332 as $c7a8c2342d0465b628e10bcf97d8d5f2 => $a78bcdca9d9cbbd340e59c21511b8ba8) {
                        if (isset($a78bcdca9d9cbbd340e59c21511b8ba8[$this->description_field]) && $this->description_field != "Description") {
                            $f2a58451c087527a94a6a79b864c2332[$c7a8c2342d0465b628e10bcf97d8d5f2]["Description"] = $a78bcdca9d9cbbd340e59c21511b8ba8[$this->description_field];
                        }
                    }
                }
            }
        } else {
            $Dbd029669c4ac2a513a951ef71683ee8 = $this->db->query("SELECT `type`, `value` FROM `" . DB_PREFIX . "novaposhta_references` WHERE `type` != 'cargo_description'")->rows;
            if (is_array($Dbd029669c4ac2a513a951ef71683ee8)) {
                foreach ($Dbd029669c4ac2a513a951ef71683ee8 as $C49b17346897695b090405e70076f41f) {
                    $f2a58451c087527a94a6a79b864c2332[$C49b17346897695b090405e70076f41f["type"]] = json_decode($C49b17346897695b090405e70076f41f["value"], true);
                    if (is_array($f2a58451c087527a94a6a79b864c2332[$C49b17346897695b090405e70076f41f["type"]])) {
                        foreach ($f2a58451c087527a94a6a79b864c2332[$C49b17346897695b090405e70076f41f["type"]] as $c7a8c2342d0465b628e10bcf97d8d5f2 => $a78bcdca9d9cbbd340e59c21511b8ba8) {
                            if (isset($a78bcdca9d9cbbd340e59c21511b8ba8[$this->description_field]) && $this->description_field != "Description") {
                                $f2a58451c087527a94a6a79b864c2332[$C49b17346897695b090405e70076f41f["type"]][$c7a8c2342d0465b628e10bcf97d8d5f2]["Description"] = $a78bcdca9d9cbbd340e59c21511b8ba8[$this->description_field];
                            }
                        }
                    }
                }
            }
        }
        return $f2a58451c087527a94a6a79b864c2332;
    }
    public function getCounterparties($Cb46073bc6795ee0c3e428ad7aac03ea, $c58203fb431f69c4ab61cc7cc3eabdbf = "", $f7170fe24e55d5cf07fa50847543e861 = "")
    {
        $a90cfdbef046afd4b81d84103ad6c989 = array("CounterpartyProperty" => $Cb46073bc6795ee0c3e428ad7aac03ea);
        if ($c58203fb431f69c4ab61cc7cc3eabdbf && !preg_match("/[^А-яҐґЄєIіЇїё0-9\\-\\`'\\s]+/iu", $c58203fb431f69c4ab61cc7cc3eabdbf)) {
            $a90cfdbef046afd4b81d84103ad6c989["FindByString"] = $c58203fb431f69c4ab61cc7cc3eabdbf;
        }
        if ($f7170fe24e55d5cf07fa50847543e861) {
            $a90cfdbef046afd4b81d84103ad6c989["CityRef"] = $f7170fe24e55d5cf07fa50847543e861;
        }
        $f2a58451c087527a94a6a79b864c2332 = $this->apiRequest("Counterparty", "getCounterparties", $a90cfdbef046afd4b81d84103ad6c989);
        if (is_array($f2a58451c087527a94a6a79b864c2332)) {
            foreach ($f2a58451c087527a94a6a79b864c2332 as $c7a8c2342d0465b628e10bcf97d8d5f2 => $a78bcdca9d9cbbd340e59c21511b8ba8) {
                $f2a58451c087527a94a6a79b864c2332[$a78bcdca9d9cbbd340e59c21511b8ba8["Ref"]] = $a78bcdca9d9cbbd340e59c21511b8ba8;
                unset($f2a58451c087527a94a6a79b864c2332[$c7a8c2342d0465b628e10bcf97d8d5f2]);
            }
        }
        return $f2a58451c087527a94a6a79b864c2332;
    }
    public function saveCounterparties($a90cfdbef046afd4b81d84103ad6c989)
    {
        $f2a58451c087527a94a6a79b864c2332 = $this->apiRequest("Counterparty", "save", $a90cfdbef046afd4b81d84103ad6c989);
        return isset($f2a58451c087527a94a6a79b864c2332[0]) ? $f2a58451c087527a94a6a79b864c2332[0] : $f2a58451c087527a94a6a79b864c2332;
    }
    public function getCounterpartyOptions($a341e627d70b1dbf3683bef9a6bfc4a5)
    {
        $a90cfdbef046afd4b81d84103ad6c989 = array("Ref" => $a341e627d70b1dbf3683bef9a6bfc4a5);
        $f2a58451c087527a94a6a79b864c2332 = $this->apiRequest("Counterparty", "getCounterpartyOptions", $a90cfdbef046afd4b81d84103ad6c989);
        return isset($f2a58451c087527a94a6a79b864c2332[0]) ? $f2a58451c087527a94a6a79b864c2332[0] : $f2a58451c087527a94a6a79b864c2332;
    }
    public function getContactPerson($a341e627d70b1dbf3683bef9a6bfc4a5, $c58203fb431f69c4ab61cc7cc3eabdbf = "")
    {
        $a90cfdbef046afd4b81d84103ad6c989 = array("Ref" => $a341e627d70b1dbf3683bef9a6bfc4a5);
        if ($c58203fb431f69c4ab61cc7cc3eabdbf) {
            $a90cfdbef046afd4b81d84103ad6c989["FindByString"] = $c58203fb431f69c4ab61cc7cc3eabdbf;
        }
        $f2a58451c087527a94a6a79b864c2332 = $this->apiRequest("Counterparty", "getCounterpartyContactPersons", $a90cfdbef046afd4b81d84103ad6c989);
        if (is_array($f2a58451c087527a94a6a79b864c2332)) {
            foreach ($f2a58451c087527a94a6a79b864c2332 as $c7a8c2342d0465b628e10bcf97d8d5f2 => $a78bcdca9d9cbbd340e59c21511b8ba8) {
                $f2a58451c087527a94a6a79b864c2332[$a78bcdca9d9cbbd340e59c21511b8ba8["Ref"]] = $a78bcdca9d9cbbd340e59c21511b8ba8;
                unset($f2a58451c087527a94a6a79b864c2332[$c7a8c2342d0465b628e10bcf97d8d5f2]);
            }
        }
        return $f2a58451c087527a94a6a79b864c2332;
    }
    public function saveContactPerson($a90cfdbef046afd4b81d84103ad6c989)
    {
        $f2a58451c087527a94a6a79b864c2332 = $this->apiRequest("ContactPerson", "save", $a90cfdbef046afd4b81d84103ad6c989);
        return isset($f2a58451c087527a94a6a79b864c2332[0]) ? $f2a58451c087527a94a6a79b864c2332[0] : false;
    }
    public function updateContactPerson($a90cfdbef046afd4b81d84103ad6c989)
    {
        $f2a58451c087527a94a6a79b864c2332 = $this->apiRequest("ContactPerson", "update", $a90cfdbef046afd4b81d84103ad6c989);
        return $f2a58451c087527a94a6a79b864c2332;
    }
    public function getCounterpartyAddresses($C6bb6a8fdf34a479d31109b92281c717, $Cb46073bc6795ee0c3e428ad7aac03ea, $f7170fe24e55d5cf07fa50847543e861 = "")
    {
        $a90cfdbef046afd4b81d84103ad6c989 = array("Ref" => $C6bb6a8fdf34a479d31109b92281c717, "CounterpartyProperty" => $Cb46073bc6795ee0c3e428ad7aac03ea);
        if ($f7170fe24e55d5cf07fa50847543e861) {
            $a90cfdbef046afd4b81d84103ad6c989["CityRef"] = $f7170fe24e55d5cf07fa50847543e861;
        }
        $f2a58451c087527a94a6a79b864c2332 = $this->apiRequest("Counterparty", "getCounterpartyAddresses", $a90cfdbef046afd4b81d84103ad6c989);
        if (is_array($f2a58451c087527a94a6a79b864c2332)) {
            foreach ($f2a58451c087527a94a6a79b864c2332 as $c7a8c2342d0465b628e10bcf97d8d5f2 => $a78bcdca9d9cbbd340e59c21511b8ba8) {
                $f2a58451c087527a94a6a79b864c2332[$a78bcdca9d9cbbd340e59c21511b8ba8["Ref"]] = $a78bcdca9d9cbbd340e59c21511b8ba8;
                unset($f2a58451c087527a94a6a79b864c2332[$c7a8c2342d0465b628e10bcf97d8d5f2]);
            }
        }
        return $f2a58451c087527a94a6a79b864c2332;
    }
    public function saveAddress($a90cfdbef046afd4b81d84103ad6c989)
    {
        $f2a58451c087527a94a6a79b864c2332 = $this->apiRequest("Address", "save", $a90cfdbef046afd4b81d84103ad6c989);
        return isset($f2a58451c087527a94a6a79b864c2332[0]) ? $f2a58451c087527a94a6a79b864c2332[0] : false;
    }
    public function getSenderAddresses($C6bb6a8fdf34a479d31109b92281c717, $f7170fe24e55d5cf07fa50847543e861)
    {
        $Dbd029669c4ac2a513a951ef71683ee8 = array();
        $D85b41282ed1eda2be022a98c4b8c7cc = $this->novaposhta->getReferences("sender_addresses");
        if (isset($D85b41282ed1eda2be022a98c4b8c7cc[$C6bb6a8fdf34a479d31109b92281c717])) {
            foreach ($D85b41282ed1eda2be022a98c4b8c7cc[$C6bb6a8fdf34a479d31109b92281c717] as $c7a8c2342d0465b628e10bcf97d8d5f2 => $e1b69b28d2271454c3718f02f02e7be2) {
                if ($e1b69b28d2271454c3718f02f02e7be2["CityRef"] == $f7170fe24e55d5cf07fa50847543e861) {
                    $Dbd029669c4ac2a513a951ef71683ee8[$c7a8c2342d0465b628e10bcf97d8d5f2] = $e1b69b28d2271454c3718f02f02e7be2;
                }
            }
        }
        return $Dbd029669c4ac2a513a951ef71683ee8;
    }
    public function getTimeIntervals($a341e627d70b1dbf3683bef9a6bfc4a5, $fd6d78540ddf152f3dae5ed535185de9 = "")
    {
        $a90cfdbef046afd4b81d84103ad6c989 = array("RecipientCityRef" => $a341e627d70b1dbf3683bef9a6bfc4a5, "DateTime" => $fd6d78540ddf152f3dae5ed535185de9);
        $f2a58451c087527a94a6a79b864c2332 = $this->apiRequest("Common", "getTimeIntervals", $a90cfdbef046afd4b81d84103ad6c989);
        return $f2a58451c087527a94a6a79b864c2332;
    }
    public function getErrors()
    {
        $f2a58451c087527a94a6a79b864c2332 = $this->apiRequest("CommonGeneral", "getMessageCodeText");
        if (is_array($f2a58451c087527a94a6a79b864c2332)) {
            foreach ($f2a58451c087527a94a6a79b864c2332 as $c7a8c2342d0465b628e10bcf97d8d5f2 => $a78bcdca9d9cbbd340e59c21511b8ba8) {
                $f2a58451c087527a94a6a79b864c2332[$a78bcdca9d9cbbd340e59c21511b8ba8["MessageCode"]] = array("MessageCode" => $a78bcdca9d9cbbd340e59c21511b8ba8["MessageCode"], "Description" => $a78bcdca9d9cbbd340e59c21511b8ba8["MessageDescriptionUA"], "DescriptionRu" => $a78bcdca9d9cbbd340e59c21511b8ba8["MessageDescriptionRU"], "DescriptionEn" => $a78bcdca9d9cbbd340e59c21511b8ba8["MessageText"]);
                unset($f2a58451c087527a94a6a79b864c2332[$c7a8c2342d0465b628e10bcf97d8d5f2]);
            }
        }
        return $f2a58451c087527a94a6a79b864c2332;
    }
    public function getDocumentPrice($a90cfdbef046afd4b81d84103ad6c989)
    {
        $Dbdc9ce4cf5144c5afe889cee6c21e99 = 0;
        $f2a58451c087527a94a6a79b864c2332 = $this->apiRequest("InternetDocument", "getDocumentPrice", $a90cfdbef046afd4b81d84103ad6c989);
        if (isset($f2a58451c087527a94a6a79b864c2332[0])) {
            $Dbdc9ce4cf5144c5afe889cee6c21e99 += $f2a58451c087527a94a6a79b864c2332[0]["Cost"];
            if (!empty($f2a58451c087527a94a6a79b864c2332[0]["CostPack"])) {
                $Dbdc9ce4cf5144c5afe889cee6c21e99 += $f2a58451c087527a94a6a79b864c2332[0]["CostPack"];
            }
        }
        return $Dbdc9ce4cf5144c5afe889cee6c21e99;
    }
    public function getDocumentDeliveryDate($a90cfdbef046afd4b81d84103ad6c989)
    {
        $f2a58451c087527a94a6a79b864c2332 = $this->apiRequest("InternetDocument", "getDocumentDeliveryDate", $a90cfdbef046afd4b81d84103ad6c989);
        return $f2a58451c087527a94a6a79b864c2332 ? $this->dateDiff($f2a58451c087527a94a6a79b864c2332[0]["DeliveryDate"]["date"]) : 0;
    }
    public function saveCN($a90cfdbef046afd4b81d84103ad6c989)
    {
        $c51627100c8337f31377cd06bc553953 = isset($a90cfdbef046afd4b81d84103ad6c989["Ref"]) ? "update" : "save";
        $f2a58451c087527a94a6a79b864c2332 = $this->apiRequest("InternetDocument", $c51627100c8337f31377cd06bc553953, $a90cfdbef046afd4b81d84103ad6c989);
        return isset($f2a58451c087527a94a6a79b864c2332[0]) ? $f2a58451c087527a94a6a79b864c2332[0] : false;
    }
    public function getCN($a341e627d70b1dbf3683bef9a6bfc4a5)
    {
        $a90cfdbef046afd4b81d84103ad6c989 = array("Ref" => $a341e627d70b1dbf3683bef9a6bfc4a5);
        $f2a58451c087527a94a6a79b864c2332 = $this->apiRequest("InternetDocument", "getDocument", $a90cfdbef046afd4b81d84103ad6c989);
        return isset($f2a58451c087527a94a6a79b864c2332[0]) ? $f2a58451c087527a94a6a79b864c2332[0] : false;
    }
    public function getCNList($B9de8389816e8686a9d95cf4fd420e7a = "", $Ea6310b0e123631210b3b1b80747b9ec = "", $a90cfdbef046afd4b81d84103ad6c989 = array())
    {
        $a90cfdbef046afd4b81d84103ad6c989["GetFullList"] = 1;
        if ($B9de8389816e8686a9d95cf4fd420e7a && $Ea6310b0e123631210b3b1b80747b9ec) {
            $a90cfdbef046afd4b81d84103ad6c989["DateTimeFrom"] = $B9de8389816e8686a9d95cf4fd420e7a;
            $a90cfdbef046afd4b81d84103ad6c989["DateTimeTo"] = $Ea6310b0e123631210b3b1b80747b9ec;
        } else {
            if ($B9de8389816e8686a9d95cf4fd420e7a) {
                $a90cfdbef046afd4b81d84103ad6c989["DateTime"] = $B9de8389816e8686a9d95cf4fd420e7a;
            }
        }
        $f2a58451c087527a94a6a79b864c2332 = $this->apiRequest("InternetDocument", "getDocumentList", $a90cfdbef046afd4b81d84103ad6c989);
        return $f2a58451c087527a94a6a79b864c2332;
    }
    public function deleteCN($Ec12440424341ae91b2fcd19504e7fec)
    {
        $a90cfdbef046afd4b81d84103ad6c989 = array("DocumentRefs" => $Ec12440424341ae91b2fcd19504e7fec);
        $f2a58451c087527a94a6a79b864c2332 = $this->apiRequest("InternetDocument", "delete", $a90cfdbef046afd4b81d84103ad6c989);
        return $f2a58451c087527a94a6a79b864c2332;
    }
    public function tracking($Ff3957333f291ed9632453eba8c1ef03 = array())
    {
        $a90cfdbef046afd4b81d84103ad6c989 = array("Documents" => $Ff3957333f291ed9632453eba8c1ef03);
        $f2a58451c087527a94a6a79b864c2332 = $this->apiRequest("TrackingDocument", "getStatusDocuments", $a90cfdbef046afd4b81d84103ad6c989);
        return $f2a58451c087527a94a6a79b864c2332;
    }
    public function getDeparture($a478a6b698575a37a31ef9febce074d6, $fe0a49c770d92e27faedd18c5d458060 = 1)
    {
        $f2a58451c087527a94a6a79b864c2332["parcels"] = array();
        if (empty($a478a6b698575a37a31ef9febce074d6) || !is_array($a478a6b698575a37a31ef9febce074d6)) {
            $a478a6b698575a37a31ef9febce074d6 = array(array("quantity" => 1, "weight_class_id" => 0, "length_class_id" => 0, "weight" => 0, "length" => 0, "width" => 0, "height" => 0));
        }
        foreach ($a478a6b698575a37a31ef9febce074d6 as $B7da351f8b28a831c1a196a2c8536a8f => $Bdd9a805a0a03c412fb193e05b5f433e) {
            $E194f0fc10842e555b821e2e15555c98 = $this->weight->getUnit($Bdd9a805a0a03c412fb193e05b5f433e["weight_class_id"]);
            $f89c9f91b383e68db0fcbf6741a60202 = $this->length->getUnit($Bdd9a805a0a03c412fb193e05b5f433e["length_class_id"]);
            if ($this->settings["use_parameters"] == "products_without_parameters" && (double) $Bdd9a805a0a03c412fb193e05b5f433e["weight"]) {
                $f2a58451c087527a94a6a79b864c2332["parcels"][$B7da351f8b28a831c1a196a2c8536a8f]["weight"] = $this->weightConvert($Bdd9a805a0a03c412fb193e05b5f433e["weight"], $E194f0fc10842e555b821e2e15555c98);
            } else {
                if ($this->settings["use_parameters"] == "whole_order") {
                    $f2a58451c087527a94a6a79b864c2332["parcels"][$B7da351f8b28a831c1a196a2c8536a8f]["weight"] = (double) $this->settings["weight"];
                } else {
                    $f2a58451c087527a94a6a79b864c2332["parcels"][$B7da351f8b28a831c1a196a2c8536a8f]["weight"] = (double) $this->settings["weight"] * $Bdd9a805a0a03c412fb193e05b5f433e["quantity"];
                }
            }
            if ($this->settings["use_parameters"] == "products_without_parameters" && (double) $Bdd9a805a0a03c412fb193e05b5f433e["length"]) {
                $f2a58451c087527a94a6a79b864c2332["parcels"][$B7da351f8b28a831c1a196a2c8536a8f]["length"] = $this->dimensionConvert($Bdd9a805a0a03c412fb193e05b5f433e["length"], $f89c9f91b383e68db0fcbf6741a60202);
            } else {
                $f2a58451c087527a94a6a79b864c2332["parcels"][$B7da351f8b28a831c1a196a2c8536a8f]["length"] = (double) $this->settings["dimensions_l"];
            }
            if ($this->settings["use_parameters"] == "products_without_parameters" && (double) $Bdd9a805a0a03c412fb193e05b5f433e["width"]) {
                $f2a58451c087527a94a6a79b864c2332["parcels"][$B7da351f8b28a831c1a196a2c8536a8f]["width"] = $this->dimensionConvert($Bdd9a805a0a03c412fb193e05b5f433e["width"], $f89c9f91b383e68db0fcbf6741a60202);
            } else {
                $f2a58451c087527a94a6a79b864c2332["parcels"][$B7da351f8b28a831c1a196a2c8536a8f]["width"] = (double) $this->settings["dimensions_w"];
            }
            if ($this->settings["use_parameters"] == "products_without_parameters" && (double) $Bdd9a805a0a03c412fb193e05b5f433e["height"]) {
                $f2a58451c087527a94a6a79b864c2332["parcels"][$B7da351f8b28a831c1a196a2c8536a8f]["height"] = $this->dimensionConvert($Bdd9a805a0a03c412fb193e05b5f433e["height"], $f89c9f91b383e68db0fcbf6741a60202) * $Bdd9a805a0a03c412fb193e05b5f433e["quantity"];
            } else {
                if ($this->settings["use_parameters"] == "whole_order") {
                    $f2a58451c087527a94a6a79b864c2332["parcels"][$B7da351f8b28a831c1a196a2c8536a8f]["height"] = (double) $this->settings["dimensions_h"];
                } else {
                    $f2a58451c087527a94a6a79b864c2332["parcels"][$B7da351f8b28a831c1a196a2c8536a8f]["height"] = (double) $this->settings["dimensions_h"] * $Bdd9a805a0a03c412fb193e05b5f433e["quantity"];
                }
            }
            if ($f2a58451c087527a94a6a79b864c2332["parcels"][$B7da351f8b28a831c1a196a2c8536a8f]["length"] < $f2a58451c087527a94a6a79b864c2332["parcels"][$B7da351f8b28a831c1a196a2c8536a8f]["height"]) {
                $b4cd63c274d22062fcd5cd411e1c5d77 = $f2a58451c087527a94a6a79b864c2332["parcels"][$B7da351f8b28a831c1a196a2c8536a8f]["length"];
                $f2a58451c087527a94a6a79b864c2332["parcels"][$B7da351f8b28a831c1a196a2c8536a8f]["length"] = $f2a58451c087527a94a6a79b864c2332["parcels"][$B7da351f8b28a831c1a196a2c8536a8f]["height"];
                $f2a58451c087527a94a6a79b864c2332["parcels"][$B7da351f8b28a831c1a196a2c8536a8f]["height"] = $b4cd63c274d22062fcd5cd411e1c5d77;
            }
            if (!$fe0a49c770d92e27faedd18c5d458060) {
                $f2a58451c087527a94a6a79b864c2332["parcels"][$B7da351f8b28a831c1a196a2c8536a8f]["length"] += (double) $this->settings["allowance_l"];
                $f2a58451c087527a94a6a79b864c2332["parcels"][$B7da351f8b28a831c1a196a2c8536a8f]["width"] += (double) $this->settings["allowance_w"];
                $f2a58451c087527a94a6a79b864c2332["parcels"][$B7da351f8b28a831c1a196a2c8536a8f]["height"] += (double) $this->settings["allowance_h"];
            }
            $f2a58451c087527a94a6a79b864c2332["parcels"][$B7da351f8b28a831c1a196a2c8536a8f]["volume"] = $f2a58451c087527a94a6a79b864c2332["parcels"][$B7da351f8b28a831c1a196a2c8536a8f]["length"] * $f2a58451c087527a94a6a79b864c2332["parcels"][$B7da351f8b28a831c1a196a2c8536a8f]["width"] * $f2a58451c087527a94a6a79b864c2332["parcels"][$B7da351f8b28a831c1a196a2c8536a8f]["height"] / 1000000;
            if ($this->settings["use_parameters"] == "whole_order") {
                break;
            }
        }
        if ($this->settings["calculate_volume"] && $this->settings["calculate_volume_type"] == "sum_all_products") {
            $C1acf5337c133a7656c5d10cd261231c = array_sum(array_map(function ($B7da351f8b28a831c1a196a2c8536a8f) {
                return $B7da351f8b28a831c1a196a2c8536a8f["length"];
            }, $f2a58451c087527a94a6a79b864c2332["parcels"]));
            $D593e87aed4c46a1ff8294cc059a269b = array_sum(array_map(function ($B7da351f8b28a831c1a196a2c8536a8f) {
                return $B7da351f8b28a831c1a196a2c8536a8f["width"];
            }, $f2a58451c087527a94a6a79b864c2332["parcels"]));
            $ab1ad95e04c4c42e296c3ff16cff135b = array_sum(array_map(function ($B7da351f8b28a831c1a196a2c8536a8f) {
                return $B7da351f8b28a831c1a196a2c8536a8f["height"];
            }, $f2a58451c087527a94a6a79b864c2332["parcels"]));
            $Ffdb142c56b2481f7ec382e08c079b77 = array_sum(array_map(function ($B7da351f8b28a831c1a196a2c8536a8f) {
                return $B7da351f8b28a831c1a196a2c8536a8f["volume"];
            }, $f2a58451c087527a94a6a79b864c2332["parcels"]));
        } else {
            $C1acf5337c133a7656c5d10cd261231c = max(array_map(function ($B7da351f8b28a831c1a196a2c8536a8f) {
                return $B7da351f8b28a831c1a196a2c8536a8f["length"];
            }, $f2a58451c087527a94a6a79b864c2332["parcels"]));
            $D593e87aed4c46a1ff8294cc059a269b = max(array_map(function ($B7da351f8b28a831c1a196a2c8536a8f) {
                return $B7da351f8b28a831c1a196a2c8536a8f["width"];
            }, $f2a58451c087527a94a6a79b864c2332["parcels"]));
            $ab1ad95e04c4c42e296c3ff16cff135b = max(array_map(function ($B7da351f8b28a831c1a196a2c8536a8f) {
                return $B7da351f8b28a831c1a196a2c8536a8f["height"];
            }, $f2a58451c087527a94a6a79b864c2332["parcels"]));
            $Ffdb142c56b2481f7ec382e08c079b77 = max(array_map(function ($B7da351f8b28a831c1a196a2c8536a8f) {
                return $B7da351f8b28a831c1a196a2c8536a8f["volume"];
            }, $f2a58451c087527a94a6a79b864c2332["parcels"]));
        }
        $D83f84be456bd7a22d90cb22ce70106f = array_sum(array_map(function ($B7da351f8b28a831c1a196a2c8536a8f) {
            return $B7da351f8b28a831c1a196a2c8536a8f["weight"];
        }, $f2a58451c087527a94a6a79b864c2332["parcels"]));
        if ($fe0a49c770d92e27faedd18c5d458060) {
            $C1acf5337c133a7656c5d10cd261231c = $C1acf5337c133a7656c5d10cd261231c / $fe0a49c770d92e27faedd18c5d458060 + (double) $this->settings["allowance_l"];
            $b21a62aaca0b362e1474a51100b013d4 = pow($Ffdb142c56b2481f7ec382e08c079b77, 1 / 3);
            $Ffdb142c56b2481f7ec382e08c079b77 = ($b21a62aaca0b362e1474a51100b013d4 + (double) $this->settings["allowance_l"] / 100) * ($b21a62aaca0b362e1474a51100b013d4 + (double) $this->settings["allowance_w"] / 100) * ($b21a62aaca0b362e1474a51100b013d4 + (double) $this->settings["allowance_h"] / 100) / $fe0a49c770d92e27faedd18c5d458060;
        }
        $f2a58451c087527a94a6a79b864c2332["weight"] = max(round($D83f84be456bd7a22d90cb22ce70106f, 2), 0.1);
        $f2a58451c087527a94a6a79b864c2332["length"] = max(round($C1acf5337c133a7656c5d10cd261231c), 1);
        $f2a58451c087527a94a6a79b864c2332["width"] = max(round($D593e87aed4c46a1ff8294cc059a269b), 1);
        $f2a58451c087527a94a6a79b864c2332["height"] = max(round($ab1ad95e04c4c42e296c3ff16cff135b), 1);
        $f2a58451c087527a94a6a79b864c2332["volume"] = max(round($Ffdb142c56b2481f7ec382e08c079b77, 4), 0.0004);
        return $f2a58451c087527a94a6a79b864c2332;
    }
    public function getDepartureType($f245e1fb38f019cf356fa4f8b5d5c636)
    {
        if ($f245e1fb38f019cf356fa4f8b5d5c636["length"] <= 25 && $f245e1fb38f019cf356fa4f8b5d5c636["width"] <= 35 && $f245e1fb38f019cf356fa4f8b5d5c636["height"] <= 2 && $f245e1fb38f019cf356fa4f8b5d5c636["weight"] <= 1) {
            $Bd66d56c1df4726e3ed1a1f609f40e7d = "Documents";
        } else {
            if ($f245e1fb38f019cf356fa4f8b5d5c636["length"] <= 150 && $f245e1fb38f019cf356fa4f8b5d5c636["width"] <= 150 && $f245e1fb38f019cf356fa4f8b5d5c636["height"] <= 150 && $f245e1fb38f019cf356fa4f8b5d5c636["weight"] <= 30) {
                $Bd66d56c1df4726e3ed1a1f609f40e7d = "Parcel";
            } else {
                $Bd66d56c1df4726e3ed1a1f609f40e7d = "Cargo";
            }
        }
        return $Bd66d56c1df4726e3ed1a1f609f40e7d;
    }
    public function getDepartureSeats($a478a6b698575a37a31ef9febce074d6 = array())
    {
        $fe0a49c770d92e27faedd18c5d458060 = 0;
        foreach ($a478a6b698575a37a31ef9febce074d6 as $Bdd9a805a0a03c412fb193e05b5f433e) {
            $fe0a49c770d92e27faedd18c5d458060 += $Bdd9a805a0a03c412fb193e05b5f433e["quantity"];
        }
        return $fe0a49c770d92e27faedd18c5d458060;
    }
    public function getPackType($f245e1fb38f019cf356fa4f8b5d5c636)
    {
        $bd7ed617290d1a3c14d25945e8e84ad4 = $this->getReferences("pack_types");
        if (is_array($bd7ed617290d1a3c14d25945e8e84ad4)) {
            $bd7ed617290d1a3c14d25945e8e84ad4 = $this->multiSort($bd7ed617290d1a3c14d25945e8e84ad4, "Length", "Width", "Height");
        }
        foreach ($bd7ed617290d1a3c14d25945e8e84ad4 as $Cafc766e453c7b636275d4f07d2fcab5) {
            if (in_array($Cafc766e453c7b636275d4f07d2fcab5["Ref"], $this->settings["pack_type"]) && $f245e1fb38f019cf356fa4f8b5d5c636["length"] * 10 <= $Cafc766e453c7b636275d4f07d2fcab5["Length"] && $f245e1fb38f019cf356fa4f8b5d5c636["width"] * 10 <= $Cafc766e453c7b636275d4f07d2fcab5["Width"] && ($f245e1fb38f019cf356fa4f8b5d5c636["height"] * 10 <= $Cafc766e453c7b636275d4f07d2fcab5["Height"] || !(double) $Cafc766e453c7b636275d4f07d2fcab5["Height"])) {
                return $Cafc766e453c7b636275d4f07d2fcab5["Ref"];
            }
        }
    }
    public function weightConvert($Ebf8c000d665e3092078ac1a02bd94eb, $F0476d86ef47e7daffd0da97ad0510c2)
    {
        if (preg_match("/\\b(g|gr|gram|gramm|gramme|г|гр|грам|грамм)\\b\\.?/ui", $F0476d86ef47e7daffd0da97ad0510c2)) {
            return (double) $Ebf8c000d665e3092078ac1a02bd94eb / 1000;
        }
        return (double) $Ebf8c000d665e3092078ac1a02bd94eb;
    }
    public function dimensionConvert($Ebf8c000d665e3092078ac1a02bd94eb, $F0476d86ef47e7daffd0da97ad0510c2)
    {
        if (preg_match("/\\b(mm|millimeter|мм|міліметр|миллиметр)\\b\\.?/ui", $F0476d86ef47e7daffd0da97ad0510c2)) {
            return (double) $Ebf8c000d665e3092078ac1a02bd94eb / 10;
        }
        if (preg_match("/\\b(dm|decimetre|дц|дециметр)\\b\\.?/ui", $F0476d86ef47e7daffd0da97ad0510c2)) {
            return (double) $Ebf8c000d665e3092078ac1a02bd94eb * 10;
        }
        if (preg_match("/\\b(m|metre|м|метр)\\b\\.?/ui", $F0476d86ef47e7daffd0da97ad0510c2)) {
            return (double) $Ebf8c000d665e3092078ac1a02bd94eb * 100;
        }
        return (double) $Ebf8c000d665e3092078ac1a02bd94eb;
    }
    public function dateDiff($dc89edb1bfe6287a295a39265b8c931c)
    {
        return ceil((strtotime($dc89edb1bfe6287a295a39265b8c931c) - time()) / 86400);
    }
    private function multiSort()
    {
        $eb51764c23b301c6aa67e6df984e1db7 = func_get_args();
        $ba3d6a1b1b38d73f1aba9b460457930a = count($eb51764c23b301c6aa67e6df984e1db7);
        if ($ba3d6a1b1b38d73f1aba9b460457930a >= 2) {
            $c90ba8a5e22fbe614b07e2d33d8c4651 = array_splice($eb51764c23b301c6aa67e6df984e1db7, 0, 1);
            $c90ba8a5e22fbe614b07e2d33d8c4651 = $c90ba8a5e22fbe614b07e2d33d8c4651[0];
            usort($c90ba8a5e22fbe614b07e2d33d8c4651, function ($ec14fce4d1cff93e62a91b2d3a871481, $a7278f53b03108b3a5f79431ca26df1e) use($eb51764c23b301c6aa67e6df984e1db7) {
                $B7da351f8b28a831c1a196a2c8536a8f = 0;
                $ba3d6a1b1b38d73f1aba9b460457930a = count($eb51764c23b301c6aa67e6df984e1db7);
                $D38bffc0b05bb807c749c3b26d5ef80b = 0;
                while (!($D38bffc0b05bb807c749c3b26d5ef80b == 0 && $B7da351f8b28a831c1a196a2c8536a8f < $ba3d6a1b1b38d73f1aba9b460457930a)) {
                    return $D38bffc0b05bb807c749c3b26d5ef80b;
                }
                if ($ec14fce4d1cff93e62a91b2d3a871481[$eb51764c23b301c6aa67e6df984e1db7[$B7da351f8b28a831c1a196a2c8536a8f]] == $a7278f53b03108b3a5f79431ca26df1e[$eb51764c23b301c6aa67e6df984e1db7[$B7da351f8b28a831c1a196a2c8536a8f]]) {
                    $D38bffc0b05bb807c749c3b26d5ef80b = 0;
                } else {
                    if ($ec14fce4d1cff93e62a91b2d3a871481[$eb51764c23b301c6aa67e6df984e1db7[$B7da351f8b28a831c1a196a2c8536a8f]] < $a7278f53b03108b3a5f79431ca26df1e[$eb51764c23b301c6aa67e6df984e1db7[$B7da351f8b28a831c1a196a2c8536a8f]]) {
                        $D38bffc0b05bb807c749c3b26d5ef80b = -1;
                    } else {
                        $D38bffc0b05bb807c749c3b26d5ef80b = 1;
                    }
                }
                $B7da351f8b28a831c1a196a2c8536a8f++;
            });
            return $c90ba8a5e22fbe614b07e2d33d8c4651;
        }
        return false;
    }
}

?>