<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

class ControllerShippingNovaPoshta extends Controller
{
    protected $extension = "novaposhta";
    protected $extensionId = "8081738";
    protected $version = "3.5.0";
    protected $data = array();
    protected static $license = NULL;
    private $error = array();
    private $settings = NULL;
    public function __construct($c73680b56a4291ae4dcc074ca3b468fd)
    {
        $this->registry = $c73680b56a4291ae4dcc074ca3b468fd;
        require_once DIR_SYSTEM . "helper/" . $this->extension . ".php";
        $c73680b56a4291ae4dcc074ca3b468fd->set("pr", new Pr($c73680b56a4291ae4dcc074ca3b468fd));
        $c73680b56a4291ae4dcc074ca3b468fd->set($this->extension, new NovaPoshta($c73680b56a4291ae4dcc074ca3b468fd));
        if (version_compare(VERSION, "3", ">=")) {
            $this->settings = $this->config->get("shipping_" . $this->extension);
        } else {
            $this->settings = $this->config->get($this->extension);
        }
    }
    public function install()
    {
        if (version_compare(VERSION, "2.3", ">=")) {
            $this->load->model("extension/shipping/" . $this->extension);
            $this->{"model_extension_shipping_" . $this->extension}->creatTables();
        } else {
            $this->load->model("shipping/" . $this->extension);
            $this->{"model_shipping_" . $this->extension}->creatTables();
        }
    }
    public function uninstall()
    {
        if (version_compare(VERSION, "2.3", ">=")) {
            $this->load->model("extension/shipping/" . $this->extension);
            $this->{"model_extension_shipping_" . $this->extension}->deleteTables();
        } else {
            $this->load->model("shipping/" . $this->extension);
            $this->{"model_shipping_" . $this->extension}->deleteTables();
        }
    }
    public function index()
    {
        if (version_compare(VERSION, "2.3", ">=")) {
            $this->load->language("extension/shipping/" . $this->extension);
        } else {
            $this->load->language("shipping/" . $this->extension);
        }
        $this->load->model("setting/setting");
        if ($this->request->server["REQUEST_METHOD"] == "POST" && $this->validate()) {
            $this->session->data["success"] = $this->language->get("text_success_settings");
            if (version_compare(VERSION, "3", ">=")) {
                $this->model_setting_setting->editSetting("shipping_" . $this->extension, $this->request->post, $this->request->post["store_id"]);
                if (isset($this->request->post["exit"])) {
                    $this->response->redirect($this->url->link("marketplace/extension", "user_token=" . $this->session->data["user_token"] . "&type=shipping", true));
                }
            } else {
                if (version_compare(VERSION, "2.3", ">=")) {
                    $this->model_setting_setting->editSetting($this->extension, $this->request->post, $this->request->post["store_id"]);
                    if (isset($this->request->post["exit"])) {
                        $this->response->redirect($this->url->link("extension/extension", "token=" . $this->session->data["token"] . "&type=shipping", true));
                    }
                } else {
                    if (version_compare(VERSION, "2", ">=")) {
                        $this->model_setting_setting->editSetting($this->extension, $this->request->post, $this->request->post["store_id"]);
                        if (isset($this->request->get["exit"])) {
                            $this->response->redirect($this->url->link("extension/shipping", "token=" . $this->session->data["token"], "SSL"));
                        }
                    } else {
                        $this->model_setting_setting->editSetting($this->extension, $this->request->post, $this->request->post["store_id"]);
                        if (isset($this->request->get["exit"])) {
                            $this->redirect($this->url->link("extension/shipping", "token=" . $this->session->data["token"], "SSL"));
                        }
                    }
                }
            }
        }
        $this->document->setTitle($this->language->get("heading_title"));
        $this->document->addStyle("view/stylesheet/ocmax/" . $this->extension . ".css");
        if (version_compare(VERSION, "3", ">=")) {
            $c9eafa91ebf75a03dc254d64681c5d08["action"] = $this->url->link("extension/shipping/" . $this->extension, "user_token=" . $this->session->data["user_token"], true);
            $c9eafa91ebf75a03dc254d64681c5d08["action_settings"] = $this->url->link("extension/shipping/" . $this->extension . "/extensionSettings", "user_token=" . $this->session->data["user_token"], true);
            $c9eafa91ebf75a03dc254d64681c5d08["cancel"] = $this->url->link("marketplace/extension", "user_token=" . $this->session->data["user_token"] . "&type=shipping", true);
            $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"] = array();
            $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("text_home"), "href" => $this->url->link("common/dashboard", "user_token=" . $this->session->data["user_token"], true));
            $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("text_shipping"), "href" => $this->url->link("marketplace/extension", "user_token=" . $this->session->data["user_token"] . "&type=shipping", true));
            $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("heading_title"), "href" => $this->url->link("extension/shipping/" . $this->extension, "user_token=" . $this->session->data["user_token"], true));
            $c9eafa91ebf75a03dc254d64681c5d08["user_token"] = $this->session->data["user_token"];
            $Cd6c1adb6c3a62894f7402a4931be05d = "shipping_" . $this->extension;
            $Dec5098ff2e239c2f8595b0a4e2f2e67 = "extension/";
        } else {
            if (version_compare(VERSION, "2.3", ">=")) {
                $c9eafa91ebf75a03dc254d64681c5d08["action"] = $this->url->link("extension/shipping/" . $this->extension, "token=" . $this->session->data["token"], true);
                $c9eafa91ebf75a03dc254d64681c5d08["action_settings"] = $this->url->link("extension/shipping/" . $this->extension . "/extensionSettings", "token=" . $this->session->data["token"], true);
                $c9eafa91ebf75a03dc254d64681c5d08["cancel"] = $this->url->link("extension/extension", "token=" . $this->session->data["token"] . "&type=shipping", true);
                $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"] = array();
                $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("text_home"), "href" => $this->url->link("common/dashboard", "token=" . $this->session->data["token"], true));
                $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("text_shipping"), "href" => $this->url->link("extension/extension", "token=" . $this->session->data["token"] . "&type=shipping", true));
                $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("heading_title"), "href" => $this->url->link("extension/shipping/" . $this->extension, "token=" . $this->session->data["token"], true));
                $c9eafa91ebf75a03dc254d64681c5d08["token"] = $this->session->data["token"];
                $Cd6c1adb6c3a62894f7402a4931be05d = $this->extension;
                $Dec5098ff2e239c2f8595b0a4e2f2e67 = "extension/";
            } else {
                $c9eafa91ebf75a03dc254d64681c5d08["action"] = $this->url->link("extension/shipping/" . $this->extension, "token=" . $this->session->data["token"], "SSL");
                $c9eafa91ebf75a03dc254d64681c5d08["action_settings"] = $this->url->link("shipping/" . $this->extension . "/extensionSettings", "token=" . $this->session->data["token"], "SSL");
                $c9eafa91ebf75a03dc254d64681c5d08["cancel"] = $this->url->link("extension/shipping", "token=" . $this->session->data["token"], "SSL");
                $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"] = array();
                if (version_compare(VERSION, "2", ">=")) {
                    $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("text_home"), "href" => $this->url->link("common/dashboard", "token=" . $this->session->data["token"], "SSL"));
                } else {
                    $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("text_home"), "href" => $this->url->link("common/home", "token=" . $this->session->data["token"], "SSL"));
                }
                $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("text_shipping"), "href" => $this->url->link("extension/shipping", "token=" . $this->session->data["token"], "SSL"));
                $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("heading_title"), "href" => $this->url->link("shipping/" . $this->extension, "token=" . $this->session->data["token"], "SSL"));
                $c9eafa91ebf75a03dc254d64681c5d08["token"] = $this->session->data["token"];
                $Cd6c1adb6c3a62894f7402a4931be05d = $this->extension;
                $Dec5098ff2e239c2f8595b0a4e2f2e67 = "";
            }
        }
        if (isset($this->session->data["success"])) {
            $c9eafa91ebf75a03dc254d64681c5d08["success"] = $this->session->data["success"];
            unset($this->session->data["success"]);
        } else {
            $c9eafa91ebf75a03dc254d64681c5d08["success"] = "";
        }
        if (isset($this->error["warning"])) {
            $c9eafa91ebf75a03dc254d64681c5d08["error_warning"] = $this->error["warning"];
        } else {
            if (isset($this->session->data["warning"])) {
                $c9eafa91ebf75a03dc254d64681c5d08["error_warning"] = $this->session->data["warning"];
                unset($this->session->data["warning"]);
            } else {
                $c9eafa91ebf75a03dc254d64681c5d08["error_warning"] = "";
            }
        }
        if (isset($this->error["error_key_api"])) {
            $c9eafa91ebf75a03dc254d64681c5d08["error_key_api"] = $this->error["error_key_api"];
        } else {
            $c9eafa91ebf75a03dc254d64681c5d08["error_key_api"] = "";
        }
        if (version_compare(VERSION, "3", "<")) {
            $d4fe40c7a4ad3020c2f85f096122dbcf = array("heading_title", "heading_verifying_api_access", "heading_adding_custom_method", "button_save", "button_save_and_exit", "button_download_basic_settings", "button_import_settings", "button_export_settings", "button_cancel", "button_update", "button_add", "button_generate", "button_copy", "button_run", "tab_general", "tab_tariffs", "tab_database", "tab_sender", "tab_recipient", "tab_departure", "tab_payment", "tab_consignment_note", "tab_cron", "tab_support", "column_weight", "column_warehouse_service_cost", "column_doors_service_cost", "column_tariff_zone_city", "column_tariff_zone_region", "column_tariff_zone_ukraine", "column_doors_pickup", "column_doors_delivery", "column_delivery_period", "column_type", "column_date", "column_amount", "column_description", "column_action", "column_postal_company_status", "column_store_status", "column_implementation_delay", "column_notification", "column_message_template", "entry_status", "entry_debugging_mode", "entry_sort_order", "entry_key_api", "entry_image", "entry_image_output_place", "entry_curl_connecttimeout", "entry_curl_timeout", "entry_method_status", "entry_name", "entry_geo_zone", "entry_tax_class", "entry_minimum_order_amount", "entry_maximum_order_amount", "entry_free_shipping", "entry_free_cost_text", "entry_cost", "entry_api_calculation", "entry_tariff_calculation", "entry_delivery_period", "entry_warehouses_filter_weight", "entry_warehouse_types", "entry_discount", "entry_additional_commission", "entry_additional_commission_bottom", "entry_region", "entry_city", "entry_warehouse", "entry_references", "entry_sender", "entry_recipient", "entry_contact_person", "entry_phone", "entry_address", "entry_street", "entry_house", "entry_flat", "entry_preferred_delivery_date", "entry_preferred_delivery_time", "entry_autodetection_departure_type", "entry_departure_type", "entry_calculate_volume", "entry_calculate_volume_type", "entry_seats_amount", "entry_declared_cost", "entry_declared_cost_default", "entry_departure_description", "entry_departure_additional_information", "entry_use_parameters", "entry_weight", "entry_dimensions", "entry_allowance", "entry_pack", "entry_pack_type", "entry_autodetection_pack_type", "entry_delivery_payer", "entry_third_person", "entry_payment_type", "entry_payment_cod", "entry_backward_delivery", "entry_backward_delivery_payer", "entry_money_transfer_method", "entry_payment_card", "entry_payment_control", "entry_display_all_consignments", "entry_displayed_information", "entry_print_format", "entry_number_of_copies", "entry_template_type", "entry_print_type", "entry_print_start", "entry_compatible_shipping_method", "entry_consignment_create", "entry_consignment_edit", "entry_consignment_delete", "entry_consignment_assignment_to_order", "entry_menu_text", "entry_key_cron", "entry_departures_tracking", "entry_tracking_statuses", "entry_admin_notification", "entry_customer_notification", "entry_customer_notification_default", "entry_email", "entry_sms", "entry_code", "help_status", "help_debugging_mode", "help_sort_order", "help_key_api", "help_image", "help_image_output_place", "help_curl_connecttimeout", "help_curl_timeout", "help_method_status", "help_name", "help_geo_zone", "help_tax_class", "help_minimum_order_amount", "help_maximum_order_amount", "help_free_shipping", "help_free_cost_text", "help_cost", "help_api_calculation", "help_tariff_calculation", "help_delivery_period", "help_warehouses_filter_weight", "help_warehouse_types", "help_discount", "help_additional_commission", "help_additional_commission_bottom", "help_update_regions", "help_update_cities", "help_update_warehouses", "help_update_references", "help_sender", "help_sender_contact_person", "help_sender_region", "help_sender_city", "help_sender_address", "help_recipient", "help_recipient_contact_person", "help_recipient_contact_person_phone", "help_recipient_region", "help_recipient_city", "help_recipient_warehouse", "help_recipient_address", "help_recipient_street", "help_recipient_house", "help_recipient_flat", "help_preferred_delivery_date", "help_preferred_delivery_time", "help_autodetection_departure_type", "help_departure_type", "help_calculate_volume", "help_calculate_volume_type", "help_seats_amount", "help_declared_cost", "help_declared_cost_default", "help_departure_description", "help_departure_additional_information", "help_use_parameters", "help_weight", "help_dimensions", "help_allowance", "help_pack", "help_pack_type", "help_autodetection_pack_type", "help_delivery_payer", "help_third_person", "help_payment_type", "help_payment_cod", "help_backward_delivery", "help_backward_delivery_payer", "help_money_transfer_method", "help_default_payment_card", "help_payment_control", "help_display_all_consignments", "help_displayed_information", "help_print_format", "help_number_of_copies", "help_template_type", "help_print_type", "help_print_start", "help_compatible_shipping_method", "help_consignment_create", "help_consignment_edit", "help_consignment_delete", "help_consignment_assignment_to_order", "help_key_cron", "help_tracking_statuses", "text_confirm", "text_contacts", "text_instruction", "text_documentation_api", "text_settings", "text_global", "text_warehouse", "text_doors", "text_poshtomat", "text_enabled", "text_disabled", "text_all_zones", "text_yes", "text_no", "text_select", "text_none", "text_verifying_api_access", "text_parcel_tariffs", "text_grn", "text_pc", "text_kg", "text_cm", "text_pct", "text_default_departure_options", "text_pack", "text_no_backward_delivery", "text_consignment_note_list", "text_print_settings", "text_integration_with_orders", "text_base_update", "text_departures_tracking", "text_settings_departures_statuses", "text_message_template_macros", "text_help_cron", "text_order_template_macros", "text_products_template_macros", "text_cn_template_macros", "text_macros");
            foreach ($d4fe40c7a4ad3020c2f85f096122dbcf as $Edf1daf1b94919f08a0e7484afcc1dae) {
                $c9eafa91ebf75a03dc254d64681c5d08[$Edf1daf1b94919f08a0e7484afcc1dae] = $this->language->get($Edf1daf1b94919f08a0e7484afcc1dae);
            }
        }
        $c9eafa91ebf75a03dc254d64681c5d08["text_help_integration_with_orders"] = sprintf($this->language->get("text_help_integration_with_orders"), DB_PREFIX, $this->extension);
        if (isset($this->request->get["store_id"])) {
            $D7ee4f46ab5f5375bd84e04f0a493d94 = $this->model_setting_setting->getSetting($Cd6c1adb6c3a62894f7402a4931be05d, $this->request->get["store_id"]);
            if (isset($D7ee4f46ab5f5375bd84e04f0a493d94[$Cd6c1adb6c3a62894f7402a4931be05d . "_status"])) {
                $this->config->set($Cd6c1adb6c3a62894f7402a4931be05d . "_status", $D7ee4f46ab5f5375bd84e04f0a493d94[$Cd6c1adb6c3a62894f7402a4931be05d . "_status"]);
            }
            if (isset($D7ee4f46ab5f5375bd84e04f0a493d94[$Cd6c1adb6c3a62894f7402a4931be05d . "_sort_order"])) {
                $this->config->set($Cd6c1adb6c3a62894f7402a4931be05d . "_sort_order", $D7ee4f46ab5f5375bd84e04f0a493d94[$Cd6c1adb6c3a62894f7402a4931be05d . "_sort_order"]);
            }
            if (isset($D7ee4f46ab5f5375bd84e04f0a493d94[$Cd6c1adb6c3a62894f7402a4931be05d])) {
                $this->settings = $D7ee4f46ab5f5375bd84e04f0a493d94[$Cd6c1adb6c3a62894f7402a4931be05d];
            }
            $c9eafa91ebf75a03dc254d64681c5d08["store_id"] = $this->request->get["store_id"];
        } else {
            $c9eafa91ebf75a03dc254d64681c5d08["store_id"] = $this->config->get("config_store_id");
        }
        $c9eafa91ebf75a03dc254d64681c5d08["stores"][] = array("store_id" => 0, "name" => $this->config->get("config_name") . $this->language->get("text_default"));
        $this->load->model("setting/store");
        $cb9e3b7a3235614ad40d797d3b87245a = $this->model_setting_store->getStores();
        foreach ($cb9e3b7a3235614ad40d797d3b87245a as $A9aeeb15e35e230eef57cc7b72855466) {
            $c9eafa91ebf75a03dc254d64681c5d08["stores"][] = array("store_id" => $A9aeeb15e35e230eef57cc7b72855466["store_id"], "name" => $A9aeeb15e35e230eef57cc7b72855466["name"]);
        }
        $this->load->model("tool/image");
        $c9eafa91ebf75a03dc254d64681c5d08["placeholder"] = $this->model_tool_image->resize("no_image.png", 100, 100);
        $this->load->model("localisation/language");
        $c9eafa91ebf75a03dc254d64681c5d08["languages"] = $this->model_localisation_language->getLanguages();
        $c9eafa91ebf75a03dc254d64681c5d08["language_id"] = "";
        foreach ($c9eafa91ebf75a03dc254d64681c5d08["languages"] as $B672e97a8ec0a8d6b44863dff0df0111) {
            if ($B672e97a8ec0a8d6b44863dff0df0111["code"] == $this->config->get("config_admin_language")) {
                $c9eafa91ebf75a03dc254d64681c5d08["language_id"] = $B672e97a8ec0a8d6b44863dff0df0111["language_id"];
            }
            if (version_compare(VERSION, "2.2", ">=")) {
                $c9eafa91ebf75a03dc254d64681c5d08["language_flag"][$B672e97a8ec0a8d6b44863dff0df0111["language_id"]] = "language/" . $B672e97a8ec0a8d6b44863dff0df0111["code"] . "/" . $B672e97a8ec0a8d6b44863dff0df0111["code"] . ".png";
            } else {
                $c9eafa91ebf75a03dc254d64681c5d08["language_flag"][$B672e97a8ec0a8d6b44863dff0df0111["language_id"]] = "view/image/flags/" . $B672e97a8ec0a8d6b44863dff0df0111["image"];
            }
        }
        $this->load->model("localisation/geo_zone");
        $c9eafa91ebf75a03dc254d64681c5d08["geo_zones"] = $this->model_localisation_geo_zone->getGeoZones();
        $this->load->model("localisation/tax_class");
        $c9eafa91ebf75a03dc254d64681c5d08["tax_classes"] = $this->model_localisation_tax_class->getTaxClasses();
        $this->load->model("localisation/zone");
        $c9eafa91ebf75a03dc254d64681c5d08["zones"] = $this->model_localisation_zone->getZonesByCountryId($this->config->get("config_country_id"));
        $c9eafa91ebf75a03dc254d64681c5d08["totals"] = $this->getExtensions("total");
        $c9eafa91ebf75a03dc254d64681c5d08["payment_methods"] = $this->getExtensions("payment");
        $c9eafa91ebf75a03dc254d64681c5d08["shipping_methods"] = $this->getExtensions("shipping");
        $this->load->model("localisation/order_status");
        $c9eafa91ebf75a03dc254d64681c5d08["order_statuses"] = $this->model_localisation_order_status->getOrderStatuses();
        if (isset($this->request->post[$Cd6c1adb6c3a62894f7402a4931be05d . "_status"])) {
            $c9eafa91ebf75a03dc254d64681c5d08[$this->extension . "_status"] = $this->request->post[$Cd6c1adb6c3a62894f7402a4931be05d . "_status"];
        } else {
            $c9eafa91ebf75a03dc254d64681c5d08[$this->extension . "_status"] = $this->config->get($Cd6c1adb6c3a62894f7402a4931be05d . "_status");
        }
        if (isset($this->request->post[$Cd6c1adb6c3a62894f7402a4931be05d . "_sort_order"])) {
            $c9eafa91ebf75a03dc254d64681c5d08[$this->extension . "_sort_order"] = $this->request->post[$Cd6c1adb6c3a62894f7402a4931be05d . "_sort_order"];
        } else {
            $c9eafa91ebf75a03dc254d64681c5d08[$this->extension . "_sort_order"] = $this->config->get($Cd6c1adb6c3a62894f7402a4931be05d . "_sort_order");
        }
        if (isset($this->request->post[$Cd6c1adb6c3a62894f7402a4931be05d])) {
            $c9eafa91ebf75a03dc254d64681c5d08[$this->extension] = $this->request->post[$Cd6c1adb6c3a62894f7402a4931be05d];
        } else {
            $c9eafa91ebf75a03dc254d64681c5d08[$this->extension] = $this->settings;
        }
        if (isset($this->request->post[$Cd6c1adb6c3a62894f7402a4931be05d]["image"]) && is_file(DIR_IMAGE . $this->request->post[$Cd6c1adb6c3a62894f7402a4931be05d]["image"])) {
            $c9eafa91ebf75a03dc254d64681c5d08["thumb"] = $this->model_tool_image->resize($this->request->post[$Cd6c1adb6c3a62894f7402a4931be05d]["image"], 100, 100);
        } else {
            if (!empty($this->settings["image"]) && is_file(DIR_IMAGE . $this->settings["image"])) {
                $c9eafa91ebf75a03dc254d64681c5d08["thumb"] = $this->model_tool_image->resize($this->settings["image"], 100, 100);
            } else {
                $c9eafa91ebf75a03dc254d64681c5d08["thumb"] = $this->model_tool_image->resize("no_image.png", 100, 100);
            }
        }
        $bf382aada372d84aba9db3749a2059f1 = $this->novaposhta->getReferences();
        if (isset($bf382aada372d84aba9db3749a2059f1["warehouse_types"]) && is_array($bf382aada372d84aba9db3749a2059f1["warehouse_types"])) {
            $c9eafa91ebf75a03dc254d64681c5d08["warehouse_types"] = $bf382aada372d84aba9db3749a2059f1["warehouse_types"];
        } else {
            $c9eafa91ebf75a03dc254d64681c5d08["warehouse_types"] = array();
        }
        if (isset($bf382aada372d84aba9db3749a2059f1["database"]) && is_array($bf382aada372d84aba9db3749a2059f1["database"])) {
            $c9eafa91ebf75a03dc254d64681c5d08["database"] = $bf382aada372d84aba9db3749a2059f1["database"];
        } else {
            $c9eafa91ebf75a03dc254d64681c5d08["database"] = array();
        }
        if (isset($bf382aada372d84aba9db3749a2059f1["senders"]) && is_array($bf382aada372d84aba9db3749a2059f1["senders"])) {
            $c9eafa91ebf75a03dc254d64681c5d08["senders"] = $bf382aada372d84aba9db3749a2059f1["senders"];
        } else {
            $c9eafa91ebf75a03dc254d64681c5d08["senders"] = array();
        }
        if (isset($bf382aada372d84aba9db3749a2059f1["sender_contact_persons"]) && isset($bf382aada372d84aba9db3749a2059f1["sender_contact_persons"][$c9eafa91ebf75a03dc254d64681c5d08[$this->extension]["sender"]]) && is_array($bf382aada372d84aba9db3749a2059f1["sender_contact_persons"][$c9eafa91ebf75a03dc254d64681c5d08[$this->extension]["sender"]])) {
            $c9eafa91ebf75a03dc254d64681c5d08["sender_contact_persons"] = $bf382aada372d84aba9db3749a2059f1["sender_contact_persons"][$c9eafa91ebf75a03dc254d64681c5d08[$this->extension]["sender"]];
        } else {
            $c9eafa91ebf75a03dc254d64681c5d08["sender_contact_persons"] = array();
        }
        if (isset($bf382aada372d84aba9db3749a2059f1["sender_addresses"]) && $c9eafa91ebf75a03dc254d64681c5d08[$this->extension]["sender_city"]) {
            $c9eafa91ebf75a03dc254d64681c5d08["sender_addresses"] = array_merge($this->novaposhta->getSenderAddresses($c9eafa91ebf75a03dc254d64681c5d08[$this->extension]["sender"], $c9eafa91ebf75a03dc254d64681c5d08[$this->extension]["sender_city"]), $this->novaposhta->getWarehousesByCityRef($c9eafa91ebf75a03dc254d64681c5d08[$this->extension]["sender_city"]));
        } else {
            $c9eafa91ebf75a03dc254d64681c5d08["sender_addresses"] = array();
        }
        if (isset($bf382aada372d84aba9db3749a2059f1["cargo_types"]) && is_array($bf382aada372d84aba9db3749a2059f1["cargo_types"])) {
            $c9eafa91ebf75a03dc254d64681c5d08["cargo_types"] = $bf382aada372d84aba9db3749a2059f1["cargo_types"];
        } else {
            $c9eafa91ebf75a03dc254d64681c5d08["cargo_types"] = array();
        }
        if (isset($bf382aada372d84aba9db3749a2059f1["pack_types"]) && is_array($bf382aada372d84aba9db3749a2059f1["pack_types"])) {
            $c9eafa91ebf75a03dc254d64681c5d08["pack_types"] = $bf382aada372d84aba9db3749a2059f1["pack_types"];
        } else {
            $c9eafa91ebf75a03dc254d64681c5d08["pack_types"] = array();
        }
        if (isset($bf382aada372d84aba9db3749a2059f1["payer_types"]) && is_array($bf382aada372d84aba9db3749a2059f1["payer_types"])) {
            $c9eafa91ebf75a03dc254d64681c5d08["payer_types"] = $bf382aada372d84aba9db3749a2059f1["payer_types"];
        } else {
            $c9eafa91ebf75a03dc254d64681c5d08["payer_types"] = array();
        }
        if (isset($bf382aada372d84aba9db3749a2059f1["third_persons"]) && is_array($bf382aada372d84aba9db3749a2059f1["third_persons"])) {
            $c9eafa91ebf75a03dc254d64681c5d08["third_persons"] = $bf382aada372d84aba9db3749a2059f1["third_persons"];
        } else {
            $c9eafa91ebf75a03dc254d64681c5d08["third_persons"] = array();
        }
        if (isset($bf382aada372d84aba9db3749a2059f1["payment_types"]) && is_array($bf382aada372d84aba9db3749a2059f1["payment_types"])) {
            $c9eafa91ebf75a03dc254d64681c5d08["payment_types"] = $bf382aada372d84aba9db3749a2059f1["payment_types"];
        } else {
            $c9eafa91ebf75a03dc254d64681c5d08["payment_types"] = array();
        }
        if (isset($bf382aada372d84aba9db3749a2059f1["backward_delivery_types"]) && is_array($bf382aada372d84aba9db3749a2059f1["backward_delivery_types"])) {
            $c9eafa91ebf75a03dc254d64681c5d08["backward_delivery_types"] = $bf382aada372d84aba9db3749a2059f1["backward_delivery_types"];
        } else {
            $c9eafa91ebf75a03dc254d64681c5d08["backward_delivery_types"] = array();
        }
        if (isset($bf382aada372d84aba9db3749a2059f1["backward_delivery_payers"]) && is_array($bf382aada372d84aba9db3749a2059f1["backward_delivery_payers"])) {
            $c9eafa91ebf75a03dc254d64681c5d08["backward_delivery_payers"] = $bf382aada372d84aba9db3749a2059f1["backward_delivery_payers"];
        } else {
            $c9eafa91ebf75a03dc254d64681c5d08["backward_delivery_payers"] = array();
        }
        if (isset($bf382aada372d84aba9db3749a2059f1["payment_cards"]) && is_array($bf382aada372d84aba9db3749a2059f1["payment_cards"])) {
            $c9eafa91ebf75a03dc254d64681c5d08["payment_cards"] = $bf382aada372d84aba9db3749a2059f1["payment_cards"];
        } else {
            $c9eafa91ebf75a03dc254d64681c5d08["payment_cards"] = array();
        }
        if (isset($bf382aada372d84aba9db3749a2059f1["document_statuses"]) && is_array($bf382aada372d84aba9db3749a2059f1["document_statuses"])) {
            $c9eafa91ebf75a03dc254d64681c5d08["document_statuses"] = $bf382aada372d84aba9db3749a2059f1["document_statuses"];
        } else {
            $c9eafa91ebf75a03dc254d64681c5d08["document_statuses"] = array();
        }
        $c9eafa91ebf75a03dc254d64681c5d08["image_output_places"] = array("title" => $this->language->get("text_image_output_place_title"), "img_key" => $this->language->get("text_image_output_place_img_key"));
        $c9eafa91ebf75a03dc254d64681c5d08["calculate_volume_types"] = array("sum_all_products" => $this->language->get("text_sum_all_products_volume"), "largest_product" => $this->language->get("text_largest_product_volume"));
        $c9eafa91ebf75a03dc254d64681c5d08["use_parameters"] = array("products_without_parameters" => $this->language->get("text_products_without_parameters"), "all_products" => $this->language->get("text_all_products"), "whole_order" => $this->language->get("text_whole_order"));
        $c9eafa91ebf75a03dc254d64681c5d08["money_transfer_methods"] = array("on_warehouse" => $this->language->get("text_on_warehouse"), "to_payment_card" => $this->language->get("text_to_payment_card"));
        $c9eafa91ebf75a03dc254d64681c5d08["consignment_displayed_information"] = array("cn_identifier" => $this->language->get("column_cn_identifier"), "cn_number" => $this->language->get("column_cn_number"), "order_number" => $this->language->get("column_order_number"), "create_date" => $this->language->get("column_create_date"), "actual_shipping_date" => $this->language->get("column_actual_shipping_date"), "preferred_shipping_date" => $this->language->get("column_preferred_shipping_date"), "estimated_shipping_date" => $this->language->get("column_estimated_shipping_date"), "recipient_date" => $this->language->get("column_recipient_date"), "last_updated_status_date" => $this->language->get("column_last_updated_status_date"), "sender" => $this->language->get("column_sender"), "sender_address" => $this->language->get("column_sender_address"), "recipient" => $this->language->get("column_recipient"), "recipient_address" => $this->language->get("column_recipient_address"), "weight" => $this->language->get("column_weight"), "seats_amount" => $this->language->get("column_seats_amount"), "declared_cost" => $this->language->get("column_declared_cost"), "shipping_cost" => $this->language->get("column_shipping_cost"), "backward_delivery" => $this->language->get("column_backward_delivery"), "service_type" => $this->language->get("column_service_type"), "description" => $this->language->get("column_description"), "additional_information" => $this->language->get("column_additional_information"), "payer_type" => $this->language->get("column_payer_type"), "payment_method" => $this->language->get("column_payment_method"), "departure_type" => $this->language->get("column_departure_type"), "packing_number" => $this->language->get("column_packing_number"), "rejection_reason" => $this->language->get("column_rejection_reason"), "status" => $this->language->get("column_status"));
        $c9eafa91ebf75a03dc254d64681c5d08["print_formats"] = array("document_A4" => $this->language->get("text_cn_a4"), "document_A5" => $this->language->get("text_cn_a5"), "markings_A4" => $this->language->get("text_mark"));
        $c9eafa91ebf75a03dc254d64681c5d08["template_types"] = array("html" => $this->language->get("text_html"), "pdf" => $this->language->get("text_pdf"));
        $c9eafa91ebf75a03dc254d64681c5d08["print_types"] = array("horPrint" => $this->language->get("text_horizontally"), "verPrint" => $this->language->get("text_vertically"));
        $c9eafa91ebf75a03dc254d64681c5d08["time"] = array("hour" => $this->language->get("text_hour"), "day" => $this->language->get("text_day"), "month" => $this->language->get("text_month"), "year" => $this->language->get("text_year"));
        if ($this->config->get("config_secure")) {
            $df28f0c9560eacd36fbfb0582758fe83 = "https://";
        } else {
            $df28f0c9560eacd36fbfb0582758fe83 = "http://";
        }
        if (!empty($this->settings["key_cron"])) {
            $D671d6d3d54d69eef693e2f757d0fb32 = $this->settings["key_cron"];
        } else {
            $D671d6d3d54d69eef693e2f757d0fb32 = "";
        }
        $c504390c2830546229fb911ae952cc07 = "/usr/bin/wget --no-check-certificate -O - -q -t 1";
        $c9eafa91ebf75a03dc254d64681c5d08["cron_update_regions"] = $c504390c2830546229fb911ae952cc07 . " '" . $df28f0c9560eacd36fbfb0582758fe83 . $_SERVER["HTTP_HOST"] . "/index.php?route=" . $Dec5098ff2e239c2f8595b0a4e2f2e67 . "module/" . $this->extension . "_cron/update&type=areas&key=" . $D671d6d3d54d69eef693e2f757d0fb32 . "'";
        $c9eafa91ebf75a03dc254d64681c5d08["cron_update_cities"] = $c504390c2830546229fb911ae952cc07 . " '" . $df28f0c9560eacd36fbfb0582758fe83 . $_SERVER["HTTP_HOST"] . "/index.php?route=" . $Dec5098ff2e239c2f8595b0a4e2f2e67 . "module/" . $this->extension . "_cron/update&type=cities&key=" . $D671d6d3d54d69eef693e2f757d0fb32 . "'";
        $c9eafa91ebf75a03dc254d64681c5d08["cron_update_warehouses"] = $c504390c2830546229fb911ae952cc07 . " '" . $df28f0c9560eacd36fbfb0582758fe83 . $_SERVER["HTTP_HOST"] . "/index.php?route=" . $Dec5098ff2e239c2f8595b0a4e2f2e67 . "module/" . $this->extension . "_cron/update&type=warehouses&key=" . $D671d6d3d54d69eef693e2f757d0fb32 . "'";
        $c9eafa91ebf75a03dc254d64681c5d08["cron_update_references"] = $c504390c2830546229fb911ae952cc07 . " '" . $df28f0c9560eacd36fbfb0582758fe83 . $_SERVER["HTTP_HOST"] . "/index.php?route=" . $Dec5098ff2e239c2f8595b0a4e2f2e67 . "module/" . $this->extension . "_cron/update&type=references&key=" . $D671d6d3d54d69eef693e2f757d0fb32 . "'";
        $c9eafa91ebf75a03dc254d64681c5d08["cron_departures_tracking"] = $c504390c2830546229fb911ae952cc07 . " '" . $df28f0c9560eacd36fbfb0582758fe83 . $_SERVER["HTTP_HOST"] . "/index.php?route=" . $Dec5098ff2e239c2f8595b0a4e2f2e67 . "module/" . $this->extension . "_cron/departuresTracking&key=" . $D671d6d3d54d69eef693e2f757d0fb32 . "'";
        $c9eafa91ebf75a03dc254d64681c5d08["cron_departures_tracking_href"] = $df28f0c9560eacd36fbfb0582758fe83 . $_SERVER["HTTP_HOST"] . "/index.php?route=" . $Dec5098ff2e239c2f8595b0a4e2f2e67 . "module/" . $this->extension . "_cron/departuresTracking&key=" . $D671d6d3d54d69eef693e2f757d0fb32;
        $c9eafa91ebf75a03dc254d64681c5d08["v"] = $this->version;
        $c9eafa91ebf75a03dc254d64681c5d08["license"] = $this->license;
        $c9eafa91ebf75a03dc254d64681c5d08["instruction_href"] = "https://oc-max.com/docs/" . $this->extension . "/instruction.html";
        $c9eafa91ebf75a03dc254d64681c5d08["documentation_api_href"] = "https://devcenter.novaposhta.ua/docs/services/";
        if (version_compare(VERSION, "2.3", ">=")) {
            $c9eafa91ebf75a03dc254d64681c5d08["header"] = $this->load->controller("common/header");
            $c9eafa91ebf75a03dc254d64681c5d08["column_left"] = $this->load->controller("common/column_left");
            $c9eafa91ebf75a03dc254d64681c5d08["footer"] = $this->load->controller("common/footer");
            $c9eafa91ebf75a03dc254d64681c5d08["support"] = $this->pr->support($this->license, $this->extension);
            $this->response->setOutput($this->load->view("extension/shipping/" . $this->extension, $c9eafa91ebf75a03dc254d64681c5d08));
        } else {
            if (version_compare(VERSION, "2", ">=")) {
                $c9eafa91ebf75a03dc254d64681c5d08["header"] = $this->load->controller("common/header");
                $c9eafa91ebf75a03dc254d64681c5d08["column_left"] = $this->load->controller("common/column_left");
                $c9eafa91ebf75a03dc254d64681c5d08["footer"] = $this->load->controller("common/footer");
                $c9eafa91ebf75a03dc254d64681c5d08["support"] = $this->pr->support($this->license, $this->extension);
                $this->response->setOutput($this->load->view("shipping/" . $this->extension . ".tpl", $c9eafa91ebf75a03dc254d64681c5d08));
            } else {
                $c9eafa91ebf75a03dc254d64681c5d08["header"] = $this->getChild("common/header");
                $c9eafa91ebf75a03dc254d64681c5d08["footer"] = $this->getChild("common/footer");
                $c9eafa91ebf75a03dc254d64681c5d08["support"] = $this->pr->support($this->license, $this->extension);
                $this->template = "shipping/" . $this->extension . ".tpl";
                $f4375dfd5c077f29d009e04acdf12821 = array("/<script type=\"text\\/javascript\" src=\"view\\/javascript\\/jquery\\/jquery-(.+)\\.min\\.js\"><\\/script>/", "/<script type=\"text\\/javascript\" src=\"view\\/javascript\\/jquery\\/ui\\/jquery-ui-(.+)\\.js\"><\\/script>/");
                $faa689dc97f6cc32f85cad754b285f09 = array("<script type=\"text/javascript\" src=\"https://code.jquery.com/jquery-2.1.1.min.js\"></script>\r\n\t\t\t    <script type=\"text/javascript\" src=\"https://code.jquery.com/jquery-migrate-1.2.1.min.js\"></script>\r\n\t\t\t    <script type=\"text/javascript\" src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>\r\n\t\t\t    <script type=\"text/javascript\" src=\"view/javascript/ocmax/ocmax.js\"></script>\r\n\t\t\t    <link rel=\"stylesheet\" type=\"text/css\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\" media=\"screen\" />\r\n\t\t\t    <link rel=\"stylesheet\" type=\"text/css\" href=\"view/stylesheet/ocmax/bootstrap.fix.css\" media=\"screen\" />\r\n\t\t\t    <link rel=\"stylesheet\" type=\"text/css\" href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css\" media=\"screen\" />", "<script type=\"text/javascript\" src=\"https://code.jquery.com/ui/1.8.24/jquery-ui.min.js\"></script>");
                $c9eafa91ebf75a03dc254d64681c5d08["header"] = preg_replace($f4375dfd5c077f29d009e04acdf12821, $faa689dc97f6cc32f85cad754b285f09, $c9eafa91ebf75a03dc254d64681c5d08["header"]);
                $this->data = $c9eafa91ebf75a03dc254d64681c5d08;
                $this->response->setOutput($this->render());
            }
        }
    }
    public function getCNForm()
    {
        if (version_compare(VERSION, "2.3", ">=")) {
            $this->load->language("extension/shipping/" . $this->extension);
            $this->load->model("extension/shipping/" . $this->extension);
        } else {
            $this->load->language("shipping/" . $this->extension);
            $this->load->model("shipping/" . $this->extension);
        }
        if ($this->request->server["REQUEST_METHOD"] == "POST") {
            $b9187c230b7a1f38e532c8dd391a0bff = array();
            if ($this->validate() && $this->validateCNForm()) {
                $b9187c230b7a1f38e532c8dd391a0bff["success"] = $this->request->post;
            } else {
                $b9187c230b7a1f38e532c8dd391a0bff = $this->error;
            }
            $this->response->addHeader("Content-Type: application/json");
            $this->response->setOutput(json_encode($b9187c230b7a1f38e532c8dd391a0bff));
        } else {
            if (isset($this->error["warning"])) {
                $c9eafa91ebf75a03dc254d64681c5d08["error_warning"][] = $this->error["warning"];
            } else {
                $c9eafa91ebf75a03dc254d64681c5d08["error_warning"] = array();
            }
            if (isset($this->request->get["order_id"])) {
                $D9919d43e9d5c6ff3cc948d998aaaef9 = $this->request->get["order_id"];
                $this->load->model("sale/order");
                $F899712fb45f31ac4dd57a45f5cda5e6 = $this->model_sale_order->getOrder($D9919d43e9d5c6ff3cc948d998aaaef9);
                if (!$F899712fb45f31ac4dd57a45f5cda5e6) {
                    $c9eafa91ebf75a03dc254d64681c5d08["error_warning"][] = $this->language->get("error_get_order");
                }
            } else {
                $D9919d43e9d5c6ff3cc948d998aaaef9 = 0;
                $F899712fb45f31ac4dd57a45f5cda5e6 = array();
            }
            if (!empty($F899712fb45f31ac4dd57a45f5cda5e6["novaposhta_cn_ref"])) {
                $bb4b4f98abd4abf92b959fd94c88f22f = $F899712fb45f31ac4dd57a45f5cda5e6["novaposhta_cn_ref"];
            } else {
                if (isset($this->request->get["cn_ref"])) {
                    $bb4b4f98abd4abf92b959fd94c88f22f = $this->request->get["cn_ref"];
                } else {
                    $bb4b4f98abd4abf92b959fd94c88f22f = "";
                }
            }
            if ($bb4b4f98abd4abf92b959fd94c88f22f) {
                $C944c3fb3fed36ba670b6e01b7aa2f4d = $this->novaposhta->getCN($bb4b4f98abd4abf92b959fd94c88f22f);
                if (!$C944c3fb3fed36ba670b6e01b7aa2f4d) {
                    $c9eafa91ebf75a03dc254d64681c5d08["error_warning"] = $this->novaposhta->error;
                    $c9eafa91ebf75a03dc254d64681c5d08["error_warning"][] = $this->language->get("error_get_cn");
                }
            } else {
                $C944c3fb3fed36ba670b6e01b7aa2f4d = array();
            }
            $this->document->setTitle($this->language->get("heading_title"));
            if (version_compare(VERSION, "3", ">=")) {
                $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"] = array();
                $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("text_home"), "href" => $this->url->link("common/dashboard", "user_token=" . $this->session->data["user_token"], true));
                $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("text_orders"), "href" => $this->url->link("sale/order", "user_token=" . $this->session->data["user_token"], true));
                $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("text_order"), "href" => $this->url->link("sale/order/info&order_id=" . $D9919d43e9d5c6ff3cc948d998aaaef9, "user_token=" . $this->session->data["user_token"], true));
                $c9eafa91ebf75a03dc254d64681c5d08["cn_list"] = $this->url->link("extension/shipping/novaposhta/getCNList", "user_token=" . $this->session->data["user_token"], true);
                $c9eafa91ebf75a03dc254d64681c5d08["cancel"] = $this->url->link("sale/order", "user_token=" . $this->session->data["user_token"], true);
                $c9eafa91ebf75a03dc254d64681c5d08["user_token"] = $this->session->data["user_token"];
                $Cbb660b5f9a8847e2e0f0b3f98ecf166 = "model_extension_shipping_novaposhta";
            } else {
                if (version_compare(VERSION, "2.3", ">=")) {
                    $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"] = array();
                    $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("text_home"), "href" => $this->url->link("common/dashboard", "token=" . $this->session->data["token"], true));
                    $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("text_orders"), "href" => $this->url->link("sale/order", "token=" . $this->session->data["token"], true));
                    $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("text_order"), "href" => $this->url->link("sale/order/info&order_id=" . $D9919d43e9d5c6ff3cc948d998aaaef9, "token=" . $this->session->data["token"], true));
                    $c9eafa91ebf75a03dc254d64681c5d08["cn_list"] = $this->url->link("extension/shipping/novaposhta/getCNList", "token=" . $this->session->data["token"], true);
                    $c9eafa91ebf75a03dc254d64681c5d08["cancel"] = $this->url->link("sale/order", "token=" . $this->session->data["token"], true);
                    $c9eafa91ebf75a03dc254d64681c5d08["token"] = $this->session->data["token"];
                    $Cbb660b5f9a8847e2e0f0b3f98ecf166 = "model_extension_shipping_novaposhta";
                } else {
                    $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"] = array();
                    if (version_compare(VERSION, "2", ">=")) {
                        $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("text_home"), "href" => $this->url->link("common/dashboard", "token=" . $this->session->data["token"], "SSL"));
                    } else {
                        $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("text_home"), "href" => $this->url->link("common/home", "token=" . $this->session->data["token"], "SSL"));
                    }
                    $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("text_orders"), "href" => $this->url->link("sale/order", "token=" . $this->session->data["token"], "SSL"));
                    $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("text_order"), "href" => $this->url->link("sale/order/info&order_id=" . $D9919d43e9d5c6ff3cc948d998aaaef9, "token=" . $this->session->data["token"], "SSL"));
                    $c9eafa91ebf75a03dc254d64681c5d08["cn_list"] = $this->url->link("shipping/novaposhta/getCNList", "token=" . $this->session->data["token"], "SSL");
                    $c9eafa91ebf75a03dc254d64681c5d08["cancel"] = $this->url->link("sale/order", "token=" . $this->session->data["token"], "SSL");
                    $c9eafa91ebf75a03dc254d64681c5d08["token"] = $this->session->data["token"];
                    $Cbb660b5f9a8847e2e0f0b3f98ecf166 = "model_shipping_novaposhta";
                }
            }
            if (version_compare(VERSION, "3", "<")) {
                $c9eafa91ebf75a03dc254d64681c5d08["heading_title"] = $this->language->get("heading_title");
                $c9eafa91ebf75a03dc254d64681c5d08["heading_options_seat"] = $this->language->get("heading_options_seat");
                $c9eafa91ebf75a03dc254d64681c5d08["heading_components_list"] = $this->language->get("heading_components_list");
                $c9eafa91ebf75a03dc254d64681c5d08["button_cn_list"] = $this->language->get("button_cn_list");
                $c9eafa91ebf75a03dc254d64681c5d08["button_cancel"] = $this->language->get("button_cancel");
                $c9eafa91ebf75a03dc254d64681c5d08["button_save_cn"] = $this->language->get("button_save_cn");
                $c9eafa91ebf75a03dc254d64681c5d08["button_warehouse_delivery"] = $this->language->get("button_warehouse_delivery");
                $c9eafa91ebf75a03dc254d64681c5d08["button_doors_delivery"] = $this->language->get("button_doors_delivery");
                $c9eafa91ebf75a03dc254d64681c5d08["button_poshtomat_delivery"] = $this->language->get("button_poshtomat_delivery");
                $c9eafa91ebf75a03dc254d64681c5d08["button_options_seat"] = $this->language->get("button_options_seat");
                $c9eafa91ebf75a03dc254d64681c5d08["button_add"] = $this->language->get("button_add");
                $c9eafa91ebf75a03dc254d64681c5d08["button_components_list"] = $this->language->get("button_components_list");
                $c9eafa91ebf75a03dc254d64681c5d08["column_number"] = $this->language->get("column_number");
                $c9eafa91ebf75a03dc254d64681c5d08["column_volume"] = $this->language->get("column_volume");
                $c9eafa91ebf75a03dc254d64681c5d08["column_width"] = $this->language->get("column_width");
                $c9eafa91ebf75a03dc254d64681c5d08["column_length"] = $this->language->get("column_length");
                $c9eafa91ebf75a03dc254d64681c5d08["column_height"] = $this->language->get("column_height");
                $c9eafa91ebf75a03dc254d64681c5d08["column_weight"] = $this->language->get("column_weight");
                $c9eafa91ebf75a03dc254d64681c5d08["column_volume_weight"] = $this->language->get("column_volume_weight");
                $c9eafa91ebf75a03dc254d64681c5d08["column_description"] = $this->language->get("column_description");
                $c9eafa91ebf75a03dc254d64681c5d08["column_price"] = $this->language->get("column_price");
                $c9eafa91ebf75a03dc254d64681c5d08["column_action"] = $this->language->get("column_action");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_sender"] = $this->language->get("entry_sender");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_recipient"] = $this->language->get("entry_recipient");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_third_person"] = $this->language->get("entry_third_person");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_region"] = $this->language->get("entry_region");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_city"] = $this->language->get("entry_city");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_address"] = $this->language->get("entry_address");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_warehouse"] = $this->language->get("entry_warehouse");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_street"] = $this->language->get("entry_street");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_house"] = $this->language->get("entry_house");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_flat"] = $this->language->get("entry_flat");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_contact_person"] = $this->language->get("entry_contact_person");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_phone"] = $this->language->get("entry_phone");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_departure_type"] = $this->language->get("entry_departure_type");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_redbox_barcode"] = $this->language->get("entry_redbox_barcode");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_width"] = $this->language->get("entry_width");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_length"] = $this->language->get("entry_length");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_height"] = $this->language->get("entry_height");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_weight"] = $this->language->get("entry_weight");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_volume_general"] = $this->language->get("entry_volume_general");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_volume_weight"] = $this->language->get("entry_volume_weight");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_seats_amount"] = $this->language->get("entry_seats_amount");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_declared_cost"] = $this->language->get("entry_declared_cost");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_departure_description"] = $this->language->get("entry_departure_description");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_delivery_payer"] = $this->language->get("entry_delivery_payer");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_payment_type"] = $this->language->get("entry_payment_type");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_backward_delivery"] = $this->language->get("entry_backward_delivery");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_backward_delivery_total"] = $this->language->get("entry_backward_delivery_total");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_payment_control"] = $this->language->get("entry_payment_control");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_backward_delivery_payer"] = $this->language->get("entry_backward_delivery_payer");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_money_transfer_method"] = $this->language->get("entry_money_transfer_method");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_payment_card"] = $this->language->get("entry_payment_card");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_departure_date"] = $this->language->get("entry_departure_date");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_preferred_delivery_date"] = $this->language->get("entry_preferred_delivery_date");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_preferred_delivery_time"] = $this->language->get("entry_preferred_delivery_time");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_sales_order_number"] = $this->language->get("entry_sales_order_number");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_packing_number"] = $this->language->get("entry_packing_number");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_departure_additional_information"] = $this->language->get("entry_departure_additional_information");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_rise_on_floor"] = $this->language->get("entry_rise_on_floor");
                $c9eafa91ebf75a03dc254d64681c5d08["entry_elevator"] = $this->language->get("entry_elevator");
                $c9eafa91ebf75a03dc254d64681c5d08["text_select"] = $this->language->get("text_select");
                $c9eafa91ebf75a03dc254d64681c5d08["text_sender"] = $this->language->get("text_sender");
                $c9eafa91ebf75a03dc254d64681c5d08["text_recipient"] = $this->language->get("text_recipient");
                $c9eafa91ebf75a03dc254d64681c5d08["text_departure_options"] = $this->language->get("text_departure_options");
                $c9eafa91ebf75a03dc254d64681c5d08["text_payment"] = $this->language->get("text_payment");
                $c9eafa91ebf75a03dc254d64681c5d08["text_additionally"] = $this->language->get("text_additionally");
                $c9eafa91ebf75a03dc254d64681c5d08["text_declared_cost"] = $this->language->get("text_declared_cost");
                $c9eafa91ebf75a03dc254d64681c5d08["text_during_day"] = $this->language->get("text_during_day");
                $c9eafa91ebf75a03dc254d64681c5d08["text_no_backward_delivery"] = $this->language->get("text_no_backward_delivery");
                $c9eafa91ebf75a03dc254d64681c5d08["text_grn"] = $this->language->get("text_grn");
                $c9eafa91ebf75a03dc254d64681c5d08["text_cubic_meter"] = $this->language->get("text_cubic_meter");
                $c9eafa91ebf75a03dc254d64681c5d08["text_cm"] = $this->language->get("text_cm");
                $c9eafa91ebf75a03dc254d64681c5d08["text_kg"] = $this->language->get("text_kg");
                $c9eafa91ebf75a03dc254d64681c5d08["text_pc"] = $this->language->get("text_pc");
                $c9eafa91ebf75a03dc254d64681c5d08["text_or"] = $this->language->get("text_or");
            }
            $c9eafa91ebf75a03dc254d64681c5d08["text_form"] = $C944c3fb3fed36ba670b6e01b7aa2f4d ? $this->language->get("text_form_edit") : $this->language->get("text_form_create");
            if ($C944c3fb3fed36ba670b6e01b7aa2f4d) {
                $c9eafa91ebf75a03dc254d64681c5d08["sender"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["SenderRef"];
                $c9eafa91ebf75a03dc254d64681c5d08["sender_contact_person"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["ContactSenderRef"];
                $c9eafa91ebf75a03dc254d64681c5d08["sender_contact_person_phone"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["SendersPhone"];
                $c9eafa91ebf75a03dc254d64681c5d08["sender_region"] = $this->novaposhta->getZoneIDByName($this->novaposhta->getAreaName($C944c3fb3fed36ba670b6e01b7aa2f4d["AreaSenderRef"]));
                $c9eafa91ebf75a03dc254d64681c5d08["sender_city_name"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["CitySender"];
                $c9eafa91ebf75a03dc254d64681c5d08["sender_city"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["CitySenderRef"];
                $c9eafa91ebf75a03dc254d64681c5d08["sender_address_name"] = $this->novaposhta->getWarehouseName($C944c3fb3fed36ba670b6e01b7aa2f4d["SenderAddressRef"]);
                $c9eafa91ebf75a03dc254d64681c5d08["sender_address"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["SenderAddressRef"];
                $c9eafa91ebf75a03dc254d64681c5d08["recipient_name"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["Recipient"];
                $c9eafa91ebf75a03dc254d64681c5d08["recipient"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["RecipientRef"];
                $c9eafa91ebf75a03dc254d64681c5d08["recipient_contact_person"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["ContactRecipient"];
                $c9eafa91ebf75a03dc254d64681c5d08["recipient_contact_person_phone"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["RecipientsPhone"];
                $c9eafa91ebf75a03dc254d64681c5d08["recipient_region_name"] = $this->novaposhta->getAreaName($C944c3fb3fed36ba670b6e01b7aa2f4d["AreaRecipientRef"]);
                $c9eafa91ebf75a03dc254d64681c5d08["recipient_region"] = $this->novaposhta->getZoneIDByName($c9eafa91ebf75a03dc254d64681c5d08["recipient_region_name"]);
                $c9eafa91ebf75a03dc254d64681c5d08["recipient_warehouse_name"] = $this->novaposhta->getWarehouseName($C944c3fb3fed36ba670b6e01b7aa2f4d["RecipientAddressRef"]);
                if ($c9eafa91ebf75a03dc254d64681c5d08["recipient_warehouse_name"]) {
                    if ($C944c3fb3fed36ba670b6e01b7aa2f4d["RecipientCategoryOfWarehouse"] == "Postomat") {
                        $c9eafa91ebf75a03dc254d64681c5d08["recipient_address_type"] = "poshtomat";
                    } else {
                        $c9eafa91ebf75a03dc254d64681c5d08["recipient_address_type"] = "warehouse";
                    }
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_district_name"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_city_name"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["CityRecipient"];
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_city"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["CityRecipientRef"];
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_warehouse"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["RecipientAddressRef"];
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_street_name"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_street"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_house"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_flat"] = "";
                } else {
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_address_type"] = "doors";
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_district_name"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["OriginalGeoData"]["RecipientAreaRegions"];
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_city_name"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["OriginalGeoData"]["RecipientCityName"];
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_city"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_warehouse"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_street_name"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["OriginalGeoData"]["RecipientAddressName"];
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_street"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_house"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["OriginalGeoData"]["RecipientHouse"];
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_flat"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["OriginalGeoData"]["RecipientFlat"];
                    if ($c9eafa91ebf75a03dc254d64681c5d08["recipient_city_name"]) {
                        $A59e8118f52ef3d250f7ecaf734024d5 = $this->novaposhta->searchSettlements($c9eafa91ebf75a03dc254d64681c5d08["recipient_city_name"] . " " . $c9eafa91ebf75a03dc254d64681c5d08["recipient_region_name"]);
                        foreach ($A59e8118f52ef3d250f7ecaf734024d5 as $F60396b2966c0450def64a02b7f44d41) {
                            if (!($c9eafa91ebf75a03dc254d64681c5d08["recipient_district_name"] && $c9eafa91ebf75a03dc254d64681c5d08["recipient_district_name"] != $F60396b2966c0450def64a02b7f44d41["Region"])) {
                                $c9eafa91ebf75a03dc254d64681c5d08["recipient_city"] = $F60396b2966c0450def64a02b7f44d41["Ref"];
                                break;
                            }
                        }
                    }
                    if ($c9eafa91ebf75a03dc254d64681c5d08["recipient_street_name"] && $c9eafa91ebf75a03dc254d64681c5d08["recipient_city"]) {
                        $b0c2111e120600e8b01383fdf260ac20 = $this->novaposhta->searchSettlementStreets($c9eafa91ebf75a03dc254d64681c5d08["recipient_city"], $c9eafa91ebf75a03dc254d64681c5d08["recipient_street_name"], 1);
                        if (isset($b0c2111e120600e8b01383fdf260ac20[0])) {
                            $c9eafa91ebf75a03dc254d64681c5d08["recipient_street"] = $b0c2111e120600e8b01383fdf260ac20[0]["SettlementStreetRef"];
                        }
                    }
                }
                $c9eafa91ebf75a03dc254d64681c5d08["departure"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["CargoTypeRef"];
                $c9eafa91ebf75a03dc254d64681c5d08["redbox_barcode"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["RedBoxBarcode"];
                $c9eafa91ebf75a03dc254d64681c5d08["width"] = isset($C944c3fb3fed36ba670b6e01b7aa2f4d["OptionsSeat"][0]) ? $C944c3fb3fed36ba670b6e01b7aa2f4d["OptionsSeat"][0]["volumetricWidth"] : "";
                $c9eafa91ebf75a03dc254d64681c5d08["length"] = isset($C944c3fb3fed36ba670b6e01b7aa2f4d["OptionsSeat"][0]) ? $C944c3fb3fed36ba670b6e01b7aa2f4d["OptionsSeat"][0]["volumetricLength"] : "";
                $c9eafa91ebf75a03dc254d64681c5d08["height"] = isset($C944c3fb3fed36ba670b6e01b7aa2f4d["OptionsSeat"][0]) ? $C944c3fb3fed36ba670b6e01b7aa2f4d["OptionsSeat"][0]["volumetricHeight"] : "";
                $c9eafa91ebf75a03dc254d64681c5d08["weight"] = isset($C944c3fb3fed36ba670b6e01b7aa2f4d["OptionsSeat"][0]) ? $C944c3fb3fed36ba670b6e01b7aa2f4d["OptionsSeat"][0]["weight"] : $C944c3fb3fed36ba670b6e01b7aa2f4d["Weight"];
                $c9eafa91ebf75a03dc254d64681c5d08["volume_general"] = isset($C944c3fb3fed36ba670b6e01b7aa2f4d["OptionsSeat"][0]) ? $C944c3fb3fed36ba670b6e01b7aa2f4d["OptionsSeat"][0]["volumetricVolume"] : $C944c3fb3fed36ba670b6e01b7aa2f4d["VolumeGeneral"];
                $c9eafa91ebf75a03dc254d64681c5d08["volume_weight"] = isset($C944c3fb3fed36ba670b6e01b7aa2f4d["OptionsSeat"][0]) ? $C944c3fb3fed36ba670b6e01b7aa2f4d["OptionsSeat"][0]["volumetricWeight"] : $C944c3fb3fed36ba670b6e01b7aa2f4d["VolumeWeight"];
                $c9eafa91ebf75a03dc254d64681c5d08["seats_amount"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["SeatsAmount"];
                $c9eafa91ebf75a03dc254d64681c5d08["declared_cost"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["Cost"];
                $c9eafa91ebf75a03dc254d64681c5d08["departure_description"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["Description"];
                if (isset($C944c3fb3fed36ba670b6e01b7aa2f4d["CargoDetails"]) && $C944c3fb3fed36ba670b6e01b7aa2f4d["CargoTypeRef"] == "TiresWheels") {
                    foreach ($C944c3fb3fed36ba670b6e01b7aa2f4d["CargoDetails"] as $eff0e229aa0322b02961c0569330adc7) {
                        $c9eafa91ebf75a03dc254d64681c5d08["tires_and_wheels"][$eff0e229aa0322b02961c0569330adc7["CargoDescriptionRef"]] = $eff0e229aa0322b02961c0569330adc7["Amount"];
                    }
                } else {
                    $c9eafa91ebf75a03dc254d64681c5d08["tires_and_wheels"] = array();
                }
                $c9eafa91ebf75a03dc254d64681c5d08["delivery_payer"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["PayerTypeRef"];
                $c9eafa91ebf75a03dc254d64681c5d08["third_person"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["ThirdPersonRef"];
                $c9eafa91ebf75a03dc254d64681c5d08["payment_type"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["PaymentMethodRef"];
                $c9eafa91ebf75a03dc254d64681c5d08["backward_delivery"] = isset($C944c3fb3fed36ba670b6e01b7aa2f4d["BackwardDeliveryData"][0]) ? $C944c3fb3fed36ba670b6e01b7aa2f4d["BackwardDeliveryData"][0]["CargoTypeRef"] : "N";
                $c9eafa91ebf75a03dc254d64681c5d08["backward_delivery_total"] = isset($C944c3fb3fed36ba670b6e01b7aa2f4d["BackwardDeliveryData"][0]) ? $C944c3fb3fed36ba670b6e01b7aa2f4d["BackwardDeliveryData"][0]["RedeliveryString"] : "";
                $c9eafa91ebf75a03dc254d64681c5d08["backward_delivery_payer"] = isset($C944c3fb3fed36ba670b6e01b7aa2f4d["BackwardDeliveryData"][0]) ? $C944c3fb3fed36ba670b6e01b7aa2f4d["BackwardDeliveryData"][0]["PayerTypeRef"] : $this->settings["backward_delivery_payer"];
                $c9eafa91ebf75a03dc254d64681c5d08["payment_control"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["AfterpaymentOnGoodsCost"];
                if ($C944c3fb3fed36ba670b6e01b7aa2f4d["PaymentCardToken"]) {
                    $c9eafa91ebf75a03dc254d64681c5d08["money_transfer_method"] = "to_payment_card";
                    $c9eafa91ebf75a03dc254d64681c5d08["payment_card"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["PaymentCardToken"];
                } else {
                    $c9eafa91ebf75a03dc254d64681c5d08["money_transfer_method"] = "on_warehouse";
                    $c9eafa91ebf75a03dc254d64681c5d08["payment_card"] = "";
                }
                $c9eafa91ebf75a03dc254d64681c5d08["departure_date"] = date("d.m.Y", strtotime($C944c3fb3fed36ba670b6e01b7aa2f4d["DateTime"]));
                $c9eafa91ebf75a03dc254d64681c5d08["preferred_delivery_date"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["PreferredDeliveryDate"] != "0001-01-01 00:00:00" ? date("d.m.Y", strtotime($C944c3fb3fed36ba670b6e01b7aa2f4d["PreferredDeliveryDate"])) : "";
                $c9eafa91ebf75a03dc254d64681c5d08["time_interval"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["TimeIntervalRef"];
                $c9eafa91ebf75a03dc254d64681c5d08["packing_number"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["PackingNumber"];
                $c9eafa91ebf75a03dc254d64681c5d08["sales_order_number"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["InfoRegClientBarcodes"];
                $c9eafa91ebf75a03dc254d64681c5d08["additional_information"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["AdditionalInformation"];
                $c9eafa91ebf75a03dc254d64681c5d08["rise_on_floor"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["NumberOfFloorsLifting"];
                $c9eafa91ebf75a03dc254d64681c5d08["elevator"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["Elevator"];
                $c9eafa91ebf75a03dc254d64681c5d08["time_intervals"] = $this->novaposhta->getTimeIntervals($c9eafa91ebf75a03dc254d64681c5d08["recipient_city"], $c9eafa91ebf75a03dc254d64681c5d08["preferred_delivery_date"]);
            } else {
                if ($F899712fb45f31ac4dd57a45f5cda5e6) {
                    $a4b761ef79927c46c093e3b7518506d4 = $this->{$Cbb660b5f9a8847e2e0f0b3f98ecf166}->getOrderProducts($D9919d43e9d5c6ff3cc948d998aaaef9);
                    $f66df47fadff5c269132813887792eb5 = $this->model_sale_order->getOrderTotals($D9919d43e9d5c6ff3cc948d998aaaef9);
                    if ($F899712fb45f31ac4dd57a45f5cda5e6["store_id"] != $this->config->get("config_store_id")) {
                        if (version_compare(VERSION, "3", ">=")) {
                            $Cd6c1adb6c3a62894f7402a4931be05d = "shipping_" . $this->extension;
                        } else {
                            $Cd6c1adb6c3a62894f7402a4931be05d = $this->extension;
                        }
                        $this->load->model("setting/setting");
                        $D7ee4f46ab5f5375bd84e04f0a493d94 = $this->model_setting_setting->getSetting($Cd6c1adb6c3a62894f7402a4931be05d, $F899712fb45f31ac4dd57a45f5cda5e6["store_id"]);
                        if (isset($D7ee4f46ab5f5375bd84e04f0a493d94[$Cd6c1adb6c3a62894f7402a4931be05d])) {
                            $this->settings = $D7ee4f46ab5f5375bd84e04f0a493d94[$Cd6c1adb6c3a62894f7402a4931be05d];
                        }
                    }
                    $E5250d3b353c0d6d3fdc65c1fd4beebd = array("{order_id}", "{invoice_no}", "{invoice_prefix}", "{store_name}", "{store_url}", "{customer}", "{firstname}", "{lastname}", "{email}", "{telephone}", "{fax}", "{payment_firstname}", "{payment_lastname}", "{payment_company}", "{payment_address_1}", "{payment_address_2}", "{payment_postcode}", "{payment_city}", "{payment_zone}", "{payment_zone_id}", "{payment_country}", "{shipping_firstname}", "{shipping_lastname}", "{shipping_company}", "{shipping_address_1}", "{shipping_address_2}", "{shipping_postcode}", "{shipping_city}", "{shipping_zone}", "{shipping_zone_id}", "{shipping_country}", "{comment}", "{total}", "{commission}", "{date_added}", "{date_modified}");
                    $df90878716f14ae8c0d4e24d9801c1e2 = array("order_id" => $F899712fb45f31ac4dd57a45f5cda5e6["order_id"], "invoice_no" => $F899712fb45f31ac4dd57a45f5cda5e6["invoice_no"], "invoice_prefix" => $F899712fb45f31ac4dd57a45f5cda5e6["invoice_prefix"], "store_name" => $F899712fb45f31ac4dd57a45f5cda5e6["store_name"], "store_url" => $F899712fb45f31ac4dd57a45f5cda5e6["store_url"], "customer" => $F899712fb45f31ac4dd57a45f5cda5e6["customer"], "firstname" => $F899712fb45f31ac4dd57a45f5cda5e6["firstname"], "lastname" => $F899712fb45f31ac4dd57a45f5cda5e6["lastname"], "email" => $F899712fb45f31ac4dd57a45f5cda5e6["email"], "telephone" => $F899712fb45f31ac4dd57a45f5cda5e6["telephone"], "fax" => isset($F899712fb45f31ac4dd57a45f5cda5e6["fax"]) ? $F899712fb45f31ac4dd57a45f5cda5e6["fax"] : "", "payment_firstname" => $F899712fb45f31ac4dd57a45f5cda5e6["payment_firstname"], "payment_lastname" => $F899712fb45f31ac4dd57a45f5cda5e6["payment_lastname"], "payment_company" => $F899712fb45f31ac4dd57a45f5cda5e6["payment_company"], "payment_address_1" => $F899712fb45f31ac4dd57a45f5cda5e6["payment_address_1"], "payment_address_2" => $F899712fb45f31ac4dd57a45f5cda5e6["payment_address_2"], "payment_postcode" => $F899712fb45f31ac4dd57a45f5cda5e6["payment_postcode"], "payment_city" => $F899712fb45f31ac4dd57a45f5cda5e6["payment_city"], "payment_zone" => $F899712fb45f31ac4dd57a45f5cda5e6["payment_zone"], "payment_zone_id" => $F899712fb45f31ac4dd57a45f5cda5e6["payment_zone_id"], "payment_country" => $F899712fb45f31ac4dd57a45f5cda5e6["payment_country"], "shipping_firstname" => $F899712fb45f31ac4dd57a45f5cda5e6["shipping_firstname"], "shipping_lastname" => $F899712fb45f31ac4dd57a45f5cda5e6["shipping_lastname"], "shipping_company" => $F899712fb45f31ac4dd57a45f5cda5e6["shipping_company"], "shipping_address_1" => $F899712fb45f31ac4dd57a45f5cda5e6["shipping_address_1"], "shipping_address_2" => $F899712fb45f31ac4dd57a45f5cda5e6["shipping_address_2"], "shipping_postcode" => $F899712fb45f31ac4dd57a45f5cda5e6["shipping_postcode"], "shipping_city" => $F899712fb45f31ac4dd57a45f5cda5e6["shipping_city"], "shipping_zone" => $F899712fb45f31ac4dd57a45f5cda5e6["shipping_zone"], "shipping_zone_id" => $F899712fb45f31ac4dd57a45f5cda5e6["shipping_zone_id"], "shipping_country" => $F899712fb45f31ac4dd57a45f5cda5e6["shipping_country"], "comment" => $F899712fb45f31ac4dd57a45f5cda5e6["comment"], "total" => $F899712fb45f31ac4dd57a45f5cda5e6["total"], "commission" => $F899712fb45f31ac4dd57a45f5cda5e6["commission"], "date_added" => $F899712fb45f31ac4dd57a45f5cda5e6["date_added"], "date_modified" => $F899712fb45f31ac4dd57a45f5cda5e6["date_modified"]);
                    foreach ($this->{$Cbb660b5f9a8847e2e0f0b3f98ecf166}->getSimpleFields($D9919d43e9d5c6ff3cc948d998aaaef9) as $ce260eb27a74d9377d3595069458da1b => $d76ecc0362ae05ee6a3c85af60e6ea6e) {
                        if (!in_array("{" . $ce260eb27a74d9377d3595069458da1b . "}", $E5250d3b353c0d6d3fdc65c1fd4beebd)) {
                            $E5250d3b353c0d6d3fdc65c1fd4beebd[] = "{" . $ce260eb27a74d9377d3595069458da1b . "}";
                            $df90878716f14ae8c0d4e24d9801c1e2[$ce260eb27a74d9377d3595069458da1b] = $d76ecc0362ae05ee6a3c85af60e6ea6e;
                        }
                    }
                    $f1197fa20ec76e7c03cb92fde292019e = array("{name}", "{model}", "{option}", "{sku}", "{ean}", "{upc}", "{jan}", "{isbn}", "{mpn}", "{quantity}");
                    $c9eafa91ebf75a03dc254d64681c5d08["sender"] = $this->settings["sender"];
                    $c9eafa91ebf75a03dc254d64681c5d08["sender_contact_person"] = $this->settings["sender_contact_person"];
                    $c9eafa91ebf75a03dc254d64681c5d08["sender_region"] = $this->settings["sender_region"];
                    $c9eafa91ebf75a03dc254d64681c5d08["sender_city_name"] = $this->settings["sender_city_name"];
                    $c9eafa91ebf75a03dc254d64681c5d08["sender_city"] = $this->settings["sender_city"];
                    $c9eafa91ebf75a03dc254d64681c5d08["sender_address_name"] = $this->settings["sender_address_name"];
                    $c9eafa91ebf75a03dc254d64681c5d08["sender_address"] = $this->settings["sender_address"];
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_name"] = $this->settings["recipient_name"];
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient"] = $this->settings["recipient"];
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_contact_person"] = preg_replace("/ {2,}/", " ", mb_convert_case(trim(str_replace($E5250d3b353c0d6d3fdc65c1fd4beebd, $df90878716f14ae8c0d4e24d9801c1e2, $this->settings["recipient_contact_person"])), MB_CASE_TITLE, "UTF-8"));
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_contact_person_phone"] = preg_replace("/[^0-9]/", "", str_replace($E5250d3b353c0d6d3fdc65c1fd4beebd, $df90878716f14ae8c0d4e24d9801c1e2, $this->settings["recipient_contact_person_phone"]));
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_address_type"] = "warehouse";
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_region_name"] = trim(str_replace($E5250d3b353c0d6d3fdc65c1fd4beebd, $df90878716f14ae8c0d4e24d9801c1e2, $this->settings["recipient_region"]));
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_region"] = $this->{$Cbb660b5f9a8847e2e0f0b3f98ecf166}->getZoneIDByName($c9eafa91ebf75a03dc254d64681c5d08["recipient_region_name"]);
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_district_name"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_city_name"] = trim(str_replace($E5250d3b353c0d6d3fdc65c1fd4beebd, $df90878716f14ae8c0d4e24d9801c1e2, $this->settings["recipient_city"]));
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_city"] = $this->novaposhta->getCityRef($c9eafa91ebf75a03dc254d64681c5d08["recipient_city_name"]);
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_warehouse_name"] = trim(str_replace($E5250d3b353c0d6d3fdc65c1fd4beebd, $df90878716f14ae8c0d4e24d9801c1e2, $this->settings["recipient_warehouse"]));
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_warehouse"] = $this->novaposhta->getWarehouseRef($c9eafa91ebf75a03dc254d64681c5d08["recipient_warehouse_name"]);
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_address"] = trim(str_replace($E5250d3b353c0d6d3fdc65c1fd4beebd, $df90878716f14ae8c0d4e24d9801c1e2, $this->settings["recipient_address"]));
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_street_name"] = trim(str_replace($E5250d3b353c0d6d3fdc65c1fd4beebd, $df90878716f14ae8c0d4e24d9801c1e2, $this->settings["recipient_street"]));
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_street"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_house"] = trim(str_replace($E5250d3b353c0d6d3fdc65c1fd4beebd, $df90878716f14ae8c0d4e24d9801c1e2, $this->settings["recipient_house"]));
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_flat"] = trim(str_replace($E5250d3b353c0d6d3fdc65c1fd4beebd, $df90878716f14ae8c0d4e24d9801c1e2, $this->settings["recipient_flat"]));
                    if (utf8_strlen($c9eafa91ebf75a03dc254d64681c5d08["recipient_contact_person_phone"]) == 10) {
                        $c9eafa91ebf75a03dc254d64681c5d08["recipient_contact_person_phone"] = "38" . $c9eafa91ebf75a03dc254d64681c5d08["recipient_contact_person_phone"];
                    }
                    if (!$c9eafa91ebf75a03dc254d64681c5d08["recipient_warehouse"] && !preg_match("/відділення|отделение|поштомат|почтомат|склад нп/ui", $c9eafa91ebf75a03dc254d64681c5d08["recipient_warehouse_name"]) && (!isset($F899712fb45f31ac4dd57a45f5cda5e6["shipping_code"]) || $F899712fb45f31ac4dd57a45f5cda5e6["shipping_code"] == "novaposhta.doors")) {
                        $c9eafa91ebf75a03dc254d64681c5d08["recipient_address_type"] = "doors";
                        $A59e8118f52ef3d250f7ecaf734024d5 = $this->novaposhta->searchSettlements($c9eafa91ebf75a03dc254d64681c5d08["recipient_city_name"] . " " . $c9eafa91ebf75a03dc254d64681c5d08["recipient_region_name"]);
                        foreach ($A59e8118f52ef3d250f7ecaf734024d5 as $F60396b2966c0450def64a02b7f44d41) {
                            if (!($c9eafa91ebf75a03dc254d64681c5d08["recipient_district_name"] && $c9eafa91ebf75a03dc254d64681c5d08["recipient_district_name"] != $F60396b2966c0450def64a02b7f44d41["Region"])) {
                                $c9eafa91ebf75a03dc254d64681c5d08["recipient_district_name"] = $F60396b2966c0450def64a02b7f44d41["Region"];
                                $c9eafa91ebf75a03dc254d64681c5d08["recipient_city"] = $F60396b2966c0450def64a02b7f44d41["Ref"];
                                break;
                            }
                        }
                        if ($c9eafa91ebf75a03dc254d64681c5d08["recipient_address"] && !$c9eafa91ebf75a03dc254d64681c5d08["recipient_street_name"]) {
                            $F1733f6a42dfbba89dd0eaeddf2143f6 = $this->parseAddress($c9eafa91ebf75a03dc254d64681c5d08["recipient_address"]);
                            $c9eafa91ebf75a03dc254d64681c5d08["recipient_street_name"] = $F1733f6a42dfbba89dd0eaeddf2143f6["street_type"] . " " . $F1733f6a42dfbba89dd0eaeddf2143f6["street"];
                            $c9eafa91ebf75a03dc254d64681c5d08["recipient_house"] = $F1733f6a42dfbba89dd0eaeddf2143f6["house"];
                            $c9eafa91ebf75a03dc254d64681c5d08["recipient_flat"] = $F1733f6a42dfbba89dd0eaeddf2143f6["flat"];
                        }
                        if ($c9eafa91ebf75a03dc254d64681c5d08["recipient_street_name"] && $c9eafa91ebf75a03dc254d64681c5d08["recipient_city"]) {
                            $b0c2111e120600e8b01383fdf260ac20 = $this->novaposhta->searchSettlementStreets($c9eafa91ebf75a03dc254d64681c5d08["recipient_city"], $c9eafa91ebf75a03dc254d64681c5d08["recipient_street_name"], 1);
                            if (isset($b0c2111e120600e8b01383fdf260ac20[0])) {
                                $c9eafa91ebf75a03dc254d64681c5d08["recipient_street"] = $b0c2111e120600e8b01383fdf260ac20[0]["SettlementStreetRef"];
                            }
                        }
                    } else {
                        if (preg_match("/поштомат|почтомат/ui", $c9eafa91ebf75a03dc254d64681c5d08["recipient_warehouse_name"]) || isset($F899712fb45f31ac4dd57a45f5cda5e6["shipping_code"]) && $F899712fb45f31ac4dd57a45f5cda5e6["shipping_code"] == "novaposhta.poshtomat") {
                            $c9eafa91ebf75a03dc254d64681c5d08["recipient_address_type"] = "poshtomat";
                        }
                    }
                    $C8db45031acc0f94c3d3fcd46df4c0ac = $this->novaposhta->getDeparture($a4b761ef79927c46c093e3b7518506d4, 0);
                    if ($this->settings["autodetection_departure_type"]) {
                        $c9eafa91ebf75a03dc254d64681c5d08["departure"] = $this->novaposhta->getDepartureType($C8db45031acc0f94c3d3fcd46df4c0ac);
                    } else {
                        if (!empty($this->settings["departure_type"])) {
                            $c9eafa91ebf75a03dc254d64681c5d08["departure"] = $this->settings["departure_type"];
                        } else {
                            $c9eafa91ebf75a03dc254d64681c5d08["departure"] = "Parcel";
                        }
                    }
                    if ($this->settings["seats_amount"]) {
                        $c9eafa91ebf75a03dc254d64681c5d08["seats_amount"] = $this->settings["seats_amount"];
                    } else {
                        $c9eafa91ebf75a03dc254d64681c5d08["seats_amount"] = $this->novaposhta->getDepartureSeats($a4b761ef79927c46c093e3b7518506d4);
                    }
                    $c9eafa91ebf75a03dc254d64681c5d08["redbox_barcode"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["tires_and_wheels"] = array();
                    $c9eafa91ebf75a03dc254d64681c5d08["width"] = $C8db45031acc0f94c3d3fcd46df4c0ac["width"];
                    $c9eafa91ebf75a03dc254d64681c5d08["length"] = $C8db45031acc0f94c3d3fcd46df4c0ac["length"];
                    $c9eafa91ebf75a03dc254d64681c5d08["height"] = $C8db45031acc0f94c3d3fcd46df4c0ac["height"];
                    $c9eafa91ebf75a03dc254d64681c5d08["weight"] = $C8db45031acc0f94c3d3fcd46df4c0ac["weight"];
                    $c9eafa91ebf75a03dc254d64681c5d08["volume_general"] = $C8db45031acc0f94c3d3fcd46df4c0ac["volume"];
                    $c9eafa91ebf75a03dc254d64681c5d08["volume_weight"] = $c9eafa91ebf75a03dc254d64681c5d08["volume_general"] * 250;
                    $c9eafa91ebf75a03dc254d64681c5d08["declared_cost"] = $this->convertToUAH($this->getDeclaredCost($f66df47fadff5c269132813887792eb5), $F899712fb45f31ac4dd57a45f5cda5e6["currency_code"], $F899712fb45f31ac4dd57a45f5cda5e6["currency_value"]);
                    $c9eafa91ebf75a03dc254d64681c5d08["departure_description"] = $this->settings["departure_description"];
                    if ($this->settings["shipping_methods"][$c9eafa91ebf75a03dc254d64681c5d08["recipient_address_type"]]["free_shipping"] && $this->settings["shipping_methods"][$c9eafa91ebf75a03dc254d64681c5d08["recipient_address_type"]]["free_shipping"] <= $this->convertToUAH($f66df47fadff5c269132813887792eb5[count($f66df47fadff5c269132813887792eb5) - 1]["value"], $F899712fb45f31ac4dd57a45f5cda5e6["currency_code"], $F899712fb45f31ac4dd57a45f5cda5e6["currency_value"])) {
                        $c9eafa91ebf75a03dc254d64681c5d08["delivery_payer"] = "Sender";
                    } else {
                        $c9eafa91ebf75a03dc254d64681c5d08["delivery_payer"] = $this->settings["delivery_payer"];
                    }
                    if (isset($F899712fb45f31ac4dd57a45f5cda5e6["payment_code"]) && isset($this->settings["payment_cod"]) && (in_array($F899712fb45f31ac4dd57a45f5cda5e6["payment_code"], $this->settings["payment_cod"]) || in_array(stristr($F899712fb45f31ac4dd57a45f5cda5e6["payment_code"], ".", true), $this->settings["payment_cod"]))) {
                        $c9eafa91ebf75a03dc254d64681c5d08["backward_delivery"] = "Money";
                    } else {
                        if (!isset($F899712fb45f31ac4dd57a45f5cda5e6["payment_code"]) && isset($this->settings["payment_cod"])) {
                            $c9eafa91ebf75a03dc254d64681c5d08["backward_delivery"] = $this->settings["backward_delivery"];
                            foreach ($this->settings["payment_cod"] as $fb95676b7467c06bd841c3896be6c045) {
                                if (is_array($fb95676b7467c06bd841c3896be6c045) && $fb95676b7467c06bd841c3896be6c045["name"] == $F899712fb45f31ac4dd57a45f5cda5e6["payment_method"]) {
                                    $c9eafa91ebf75a03dc254d64681c5d08["backward_delivery"] = "Money";
                                    break;
                                }
                                $this->load->language("payment/" . $fb95676b7467c06bd841c3896be6c045);
                                $f80618b9f2d714e09c9813ef76396a94 = $this->language->get("heading_title");
                                if ($F899712fb45f31ac4dd57a45f5cda5e6["payment_method"] == $f80618b9f2d714e09c9813ef76396a94) {
                                    $c9eafa91ebf75a03dc254d64681c5d08["backward_delivery"] = "Money";
                                    break;
                                }
                            }
                        } else {
                            $c9eafa91ebf75a03dc254d64681c5d08["backward_delivery"] = $this->settings["backward_delivery"];
                        }
                    }
                    if ((!$c9eafa91ebf75a03dc254d64681c5d08["backward_delivery"] || $c9eafa91ebf75a03dc254d64681c5d08["backward_delivery"] == "N" || !$c9eafa91ebf75a03dc254d64681c5d08["declared_cost"]) && $this->settings["declared_cost_default"]) {
                        $c9eafa91ebf75a03dc254d64681c5d08["declared_cost"] = $this->settings["declared_cost_default"];
                    }
                    if (version_compare(VERSION, "3", ">=")) {
                        $Ce8d6e4270f912b8d3c323c24efe0c4d = $this->config->get("payment_cod_plus");
                    } else {
                        $Ce8d6e4270f912b8d3c323c24efe0c4d = $this->config->get("cod_plus");
                    }
                    if (isset($Ce8d6e4270f912b8d3c323c24efe0c4d[$F899712fb45f31ac4dd57a45f5cda5e6["shipping_code"]])) {
                        $A5fbdedac4e799ad3012277b30a1bac4 = $Ce8d6e4270f912b8d3c323c24efe0c4d[$F899712fb45f31ac4dd57a45f5cda5e6["shipping_code"]]["free"];
                    } else {
                        if (isset($Ce8d6e4270f912b8d3c323c24efe0c4d[stristr($F899712fb45f31ac4dd57a45f5cda5e6["shipping_code"], ".", true)])) {
                            $A5fbdedac4e799ad3012277b30a1bac4 = $Ce8d6e4270f912b8d3c323c24efe0c4d[stristr($F899712fb45f31ac4dd57a45f5cda5e6["shipping_code"], ".", true)]["free"];
                        } else {
                            $A5fbdedac4e799ad3012277b30a1bac4 = 0;
                        }
                    }
                    if ($A5fbdedac4e799ad3012277b30a1bac4 && $A5fbdedac4e799ad3012277b30a1bac4 <= $c9eafa91ebf75a03dc254d64681c5d08["declared_cost"]) {
                        $c9eafa91ebf75a03dc254d64681c5d08["backward_delivery_payer"] = "Sender";
                    } else {
                        $c9eafa91ebf75a03dc254d64681c5d08["backward_delivery_payer"] = $this->settings["backward_delivery_payer"];
                    }
                    $c9eafa91ebf75a03dc254d64681c5d08["third_person"] = $this->settings["third_person"];
                    $c9eafa91ebf75a03dc254d64681c5d08["payment_type"] = $this->settings["payment_type"];
                    $c9eafa91ebf75a03dc254d64681c5d08["backward_delivery_total"] = $c9eafa91ebf75a03dc254d64681c5d08["declared_cost"];
                    $c9eafa91ebf75a03dc254d64681c5d08["money_transfer_method"] = $this->settings["money_transfer_method"];
                    $c9eafa91ebf75a03dc254d64681c5d08["payment_card"] = $this->settings["default_payment_card"];
                    if ($c9eafa91ebf75a03dc254d64681c5d08["backward_delivery"] == "Money" && !empty($this->settings["payment_control"])) {
                        $c9eafa91ebf75a03dc254d64681c5d08["backward_delivery"] = "N";
                        $c9eafa91ebf75a03dc254d64681c5d08["payment_control"] = $this->convertToUAH($this->getPaymentControl($f66df47fadff5c269132813887792eb5), $F899712fb45f31ac4dd57a45f5cda5e6["currency_code"], $F899712fb45f31ac4dd57a45f5cda5e6["currency_value"]);
                    } else {
                        $c9eafa91ebf75a03dc254d64681c5d08["payment_control"] = "";
                    }
                    $c9eafa91ebf75a03dc254d64681c5d08["departure_date"] = date("d.m.Y");
                    $c9eafa91ebf75a03dc254d64681c5d08["preferred_delivery_date"] = str_replace($E5250d3b353c0d6d3fdc65c1fd4beebd, $df90878716f14ae8c0d4e24d9801c1e2, $this->settings["preferred_delivery_date"]);
                    $c9eafa91ebf75a03dc254d64681c5d08["time_interval"] = str_replace($E5250d3b353c0d6d3fdc65c1fd4beebd, $df90878716f14ae8c0d4e24d9801c1e2, $this->settings["preferred_delivery_time"]);
                    $c9eafa91ebf75a03dc254d64681c5d08["sales_order_number"] = $D9919d43e9d5c6ff3cc948d998aaaef9;
                    $c9eafa91ebf75a03dc254d64681c5d08["packing_number"] = "";
                    if ($c9eafa91ebf75a03dc254d64681c5d08["time_interval"]) {
                        $e2c382d779b2d0c4c0dee17ebf48fb4c = str_replace(":", "", $c9eafa91ebf75a03dc254d64681c5d08["time_interval"]);
                        $c9eafa91ebf75a03dc254d64681c5d08["time_intervals"] = $this->novaposhta->getTimeIntervals($c9eafa91ebf75a03dc254d64681c5d08["recipient_city"], $c9eafa91ebf75a03dc254d64681c5d08["preferred_delivery_date"]);
                        foreach ((array) $c9eafa91ebf75a03dc254d64681c5d08["time_intervals"] as $Ca7827a12836f0d588038b05a03f503d) {
                            $A8f1a700411d55e2158a6ed35de55050 = str_replace(":", "", $Ca7827a12836f0d588038b05a03f503d["Start"]);
                            $F529d246b4704cde6b586883d8f62392 = str_replace(":", "", $Ca7827a12836f0d588038b05a03f503d["End"]);
                            if ($A8f1a700411d55e2158a6ed35de55050 <= $e2c382d779b2d0c4c0dee17ebf48fb4c && $e2c382d779b2d0c4c0dee17ebf48fb4c <= $F529d246b4704cde6b586883d8f62392) {
                                $c9eafa91ebf75a03dc254d64681c5d08["time_interval"] = $Ca7827a12836f0d588038b05a03f503d["Number"];
                                break;
                            }
                        }
                    }
                    $c9eafa91ebf75a03dc254d64681c5d08["additional_information"] = "";
                    $ba420f04ac274c02a5c139e91eab6a9c = explode("|", $this->settings["departure_additional_information"]);
                    if ($ba420f04ac274c02a5c139e91eab6a9c[0]) {
                        $c9eafa91ebf75a03dc254d64681c5d08["additional_information"] .= preg_replace(array("/\\s\\s+/", "/\\r\\r+/", "/\\n\\n+/"), " ", trim(str_replace($E5250d3b353c0d6d3fdc65c1fd4beebd, $df90878716f14ae8c0d4e24d9801c1e2, $ba420f04ac274c02a5c139e91eab6a9c[0])));
                    }
                    if (isset($ba420f04ac274c02a5c139e91eab6a9c[1])) {
                        foreach ($a4b761ef79927c46c093e3b7518506d4 as $ce260eb27a74d9377d3595069458da1b => $B99ceb6abf92b453fb5bcb278cfcd827) {
                            $E14c63da71aa5e2c92060a915e38bd9c = array("name" => $B99ceb6abf92b453fb5bcb278cfcd827["name"], "model" => $B99ceb6abf92b453fb5bcb278cfcd827["model"], "option" => "", "sku" => $B99ceb6abf92b453fb5bcb278cfcd827["sku"], "ean" => $B99ceb6abf92b453fb5bcb278cfcd827["ean"], "upc" => $B99ceb6abf92b453fb5bcb278cfcd827["upc"], "jan" => $B99ceb6abf92b453fb5bcb278cfcd827["jan"], "isbn" => $B99ceb6abf92b453fb5bcb278cfcd827["isbn"], "mpn" => $B99ceb6abf92b453fb5bcb278cfcd827["mpn"], "quantity" => $B99ceb6abf92b453fb5bcb278cfcd827["quantity"]);
                            if ($B99ceb6abf92b453fb5bcb278cfcd827["option"]) {
                                foreach ($B99ceb6abf92b453fb5bcb278cfcd827["option"] as $bc5b2d6391eadfc28949539e4c228b53) {
                                    $E14c63da71aa5e2c92060a915e38bd9c["option"] .= $bc5b2d6391eadfc28949539e4c228b53["name"] . ": " . $bc5b2d6391eadfc28949539e4c228b53["value"];
                                }
                            }
                            $c9eafa91ebf75a03dc254d64681c5d08["additional_information"] .= preg_replace(array("/\\s\\s+/", "/\\r\\r+/", "/\\n\\n+/"), " ", trim(str_replace($f1197fa20ec76e7c03cb92fde292019e, $E14c63da71aa5e2c92060a915e38bd9c, $ba420f04ac274c02a5c139e91eab6a9c[1])));
                        }
                    }
                    $c9eafa91ebf75a03dc254d64681c5d08["rise_on_floor"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["elevator"] = "";
                } else {
                    $c9eafa91ebf75a03dc254d64681c5d08["sender"] = $this->settings["sender"];
                    $c9eafa91ebf75a03dc254d64681c5d08["sender_contact_person"] = $this->settings["sender_contact_person"];
                    $c9eafa91ebf75a03dc254d64681c5d08["sender_region"] = $this->settings["sender_region"];
                    $c9eafa91ebf75a03dc254d64681c5d08["sender_city_name"] = $this->settings["sender_city_name"];
                    $c9eafa91ebf75a03dc254d64681c5d08["sender_city"] = $this->settings["sender_city"];
                    $c9eafa91ebf75a03dc254d64681c5d08["sender_address_name"] = $this->settings["sender_address_name"];
                    $c9eafa91ebf75a03dc254d64681c5d08["sender_address"] = $this->settings["sender_address"];
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_name"] = $this->settings["recipient_name"];
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient"] = $this->settings["recipient"];
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_contact_person"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_contact_person_phone"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_address_type"] = "warehouse";
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_region_name"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_region"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_district_name"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_city_name"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_city"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_warehouse_name"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_warehouse"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_street_name"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_street"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_house"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["recipient_flat"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["departure"] = $this->settings["departure_type"];
                    $c9eafa91ebf75a03dc254d64681c5d08["redbox_barcode"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["tires_and_wheels"] = array();
                    $c9eafa91ebf75a03dc254d64681c5d08["width"] = (double) $this->settings["dimensions_w"] + (double) $this->settings["allowance_w"];
                    $c9eafa91ebf75a03dc254d64681c5d08["length"] = (double) $this->settings["dimensions_l"] + (double) $this->settings["allowance_l"];
                    $c9eafa91ebf75a03dc254d64681c5d08["height"] = (double) $this->settings["dimensions_h"] + (double) $this->settings["allowance_h"];
                    $c9eafa91ebf75a03dc254d64681c5d08["weight"] = $this->settings["weight"];
                    $c9eafa91ebf75a03dc254d64681c5d08["volume_general"] = max(round(((double) $this->settings["dimensions_w"] + (double) $this->settings["allowance_w"]) * ((double) $this->settings["dimensions_l"] + (double) $this->settings["allowance_l"]) * ((double) $this->settings["dimensions_h"] + (double) $this->settings["allowance_h"]) / 1000000, 4), 0.0001);
                    $c9eafa91ebf75a03dc254d64681c5d08["volume_weight"] = $c9eafa91ebf75a03dc254d64681c5d08["volume_general"] * 250;
                    $c9eafa91ebf75a03dc254d64681c5d08["seats_amount"] = $this->settings["seats_amount"];
                    $c9eafa91ebf75a03dc254d64681c5d08["declared_cost"] = $this->settings["declared_cost_default"];
                    $c9eafa91ebf75a03dc254d64681c5d08["departure_description"] = $this->settings["departure_description"];
                    $c9eafa91ebf75a03dc254d64681c5d08["delivery_payer"] = $this->settings["delivery_payer"];
                    $c9eafa91ebf75a03dc254d64681c5d08["third_person"] = $this->settings["third_person"];
                    $c9eafa91ebf75a03dc254d64681c5d08["payment_type"] = $this->settings["payment_type"];
                    $c9eafa91ebf75a03dc254d64681c5d08["backward_delivery"] = $this->settings["backward_delivery"];
                    $c9eafa91ebf75a03dc254d64681c5d08["backward_delivery_total"] = $c9eafa91ebf75a03dc254d64681c5d08["declared_cost"];
                    $c9eafa91ebf75a03dc254d64681c5d08["backward_delivery_payer"] = $this->settings["backward_delivery_payer"];
                    $c9eafa91ebf75a03dc254d64681c5d08["money_transfer_method"] = $this->settings["money_transfer_method"];
                    $c9eafa91ebf75a03dc254d64681c5d08["payment_card"] = $this->settings["default_payment_card"];
                    $c9eafa91ebf75a03dc254d64681c5d08["payment_control"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["departure_date"] = date("d.m.Y");
                    $c9eafa91ebf75a03dc254d64681c5d08["preferred_delivery_date"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["time_interval"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["sales_order_number"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["packing_number"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["additional_information"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["rise_on_floor"] = "";
                    $c9eafa91ebf75a03dc254d64681c5d08["elevator"] = "";
                }
            }
            $this->load->model("localisation/zone");
            $c9eafa91ebf75a03dc254d64681c5d08["zones"] = $this->model_localisation_zone->getZonesByCountryId($this->config->get("config_country_id"));
            $c9eafa91ebf75a03dc254d64681c5d08["references"] = $this->novaposhta->getReferences();
            if (isset($c9eafa91ebf75a03dc254d64681c5d08["references"]["senders"]) && is_array($c9eafa91ebf75a03dc254d64681c5d08["references"]["senders"])) {
                $c9eafa91ebf75a03dc254d64681c5d08["senders"] = $c9eafa91ebf75a03dc254d64681c5d08["references"]["senders"];
            } else {
                $c9eafa91ebf75a03dc254d64681c5d08["senders"] = array();
            }
            if (isset($c9eafa91ebf75a03dc254d64681c5d08["references"]["sender_options"][$c9eafa91ebf75a03dc254d64681c5d08["sender"]]) && is_array($c9eafa91ebf75a03dc254d64681c5d08["references"]["sender_options"][$c9eafa91ebf75a03dc254d64681c5d08["sender"]])) {
                $c9eafa91ebf75a03dc254d64681c5d08["sender_options"] = $c9eafa91ebf75a03dc254d64681c5d08["references"]["sender_options"][$c9eafa91ebf75a03dc254d64681c5d08["sender"]];
            } else {
                $c9eafa91ebf75a03dc254d64681c5d08["sender_options"] = array();
            }
            if (isset($c9eafa91ebf75a03dc254d64681c5d08["references"]["sender_contact_persons"][$c9eafa91ebf75a03dc254d64681c5d08["sender"]]) && is_array($c9eafa91ebf75a03dc254d64681c5d08["references"]["sender_contact_persons"][$c9eafa91ebf75a03dc254d64681c5d08["sender"]])) {
                $c9eafa91ebf75a03dc254d64681c5d08["sender_contact_persons"] = $c9eafa91ebf75a03dc254d64681c5d08["references"]["sender_contact_persons"][$c9eafa91ebf75a03dc254d64681c5d08["sender"]];
            } else {
                $c9eafa91ebf75a03dc254d64681c5d08["sender_contact_persons"] = array();
            }
            if (isset($c9eafa91ebf75a03dc254d64681c5d08["references"]["tires_and_wheels"]) && is_array($c9eafa91ebf75a03dc254d64681c5d08["references"]["tires_and_wheels"])) {
                foreach ($c9eafa91ebf75a03dc254d64681c5d08["references"]["tires_and_wheels"] as $f3e3e72bc9710ac63cb5eec4b306fc43 => $d76ecc0362ae05ee6a3c85af60e6ea6e) {
                    $c9eafa91ebf75a03dc254d64681c5d08["references"]["tires_and_wheels"][$f3e3e72bc9710ac63cb5eec4b306fc43]["Description"] = $d76ecc0362ae05ee6a3c85af60e6ea6e[$this->novaposhta->description_field];
                    unset($c9eafa91ebf75a03dc254d64681c5d08["references"]["tires_and_wheels"][$f3e3e72bc9710ac63cb5eec4b306fc43]["DescriptionRu"]);
                }
            }
            $c9eafa91ebf75a03dc254d64681c5d08["totals"] = array();
            if (isset($f66df47fadff5c269132813887792eb5)) {
                foreach ($f66df47fadff5c269132813887792eb5 as $b0222adbf7c67815178e17a474381e97) {
                    $c9eafa91ebf75a03dc254d64681c5d08["totals"][] = array("title" => strip_tags($b0222adbf7c67815178e17a474381e97["title"]), "price" => $this->convertToUAH($b0222adbf7c67815178e17a474381e97["value"], $F899712fb45f31ac4dd57a45f5cda5e6["currency_code"], $F899712fb45f31ac4dd57a45f5cda5e6["currency_value"]), "status" => isset($this->settings["declared_cost"]) && in_array($b0222adbf7c67815178e17a474381e97["code"], (array) $this->settings["declared_cost"]) ? 1 : 0);
                }
            }
            $c9eafa91ebf75a03dc254d64681c5d08["money_transfer_methods"] = array("on_warehouse" => $this->language->get("text_on_warehouse"), "to_payment_card" => $this->language->get("text_to_payment_card"));
            $c9eafa91ebf75a03dc254d64681c5d08["order_id"] = $D9919d43e9d5c6ff3cc948d998aaaef9;
            $c9eafa91ebf75a03dc254d64681c5d08["cn_ref"] = $bb4b4f98abd4abf92b959fd94c88f22f;
            $c9eafa91ebf75a03dc254d64681c5d08["v"] = $this->version;
            if (version_compare(VERSION, "2.3", ">=")) {
                $c9eafa91ebf75a03dc254d64681c5d08["header"] = $this->load->controller("common/header");
                $c9eafa91ebf75a03dc254d64681c5d08["column_left"] = $this->load->controller("common/column_left");
                $c9eafa91ebf75a03dc254d64681c5d08["footer"] = $this->load->controller("common/footer");
                $this->response->setOutput($this->load->view("extension/shipping/" . $this->extension . "_cn_form", $c9eafa91ebf75a03dc254d64681c5d08));
            } else {
                if (version_compare(VERSION, "2", ">=")) {
                    $c9eafa91ebf75a03dc254d64681c5d08["header"] = $this->load->controller("common/header");
                    $c9eafa91ebf75a03dc254d64681c5d08["column_left"] = $this->load->controller("common/column_left");
                    $c9eafa91ebf75a03dc254d64681c5d08["footer"] = $this->load->controller("common/footer");
                    $this->response->setOutput($this->load->view("shipping/" . $this->extension . "_cn_form.tpl", $c9eafa91ebf75a03dc254d64681c5d08));
                } else {
                    $c9eafa91ebf75a03dc254d64681c5d08["header"] = $this->getChild("common/header");
                    $c9eafa91ebf75a03dc254d64681c5d08["footer"] = $this->getChild("common/footer");
                    $this->template = "shipping/" . $this->extension . "_cn_form.tpl";
                    $f4375dfd5c077f29d009e04acdf12821 = array("/<script type=\"text\\/javascript\" src=\"view\\/javascript\\/jquery\\/jquery-(.+)\\.min\\.js\"><\\/script>/", "/<script type=\"text\\/javascript\" src=\"view\\/javascript\\/jquery\\/ui\\/jquery-ui-(.+)\\.js\"><\\/script>/");
                    $faa689dc97f6cc32f85cad754b285f09 = array("<script type=\"text/javascript\" src=\"https://code.jquery.com/jquery-2.1.1.min.js\"></script>\r\n                    <script type=\"text/javascript\" src=\"https://code.jquery.com/jquery-migrate-1.2.1.min.js\"></script>\r\n                    <script type=\"text/javascript\" src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>\r\n                    <script type=\"text/javascript\" src=\"view/javascript/ocmax/moment.min.js\"></script>\r\n                    <script type=\"text/javascript\" src=\"view/javascript/ocmax/bootstrap-datetimepicker.min.js\"></script>\r\n                    <script type=\"text/javascript\" src=\"view/javascript/ocmax/ocmax.js\"></script>\r\n                    <link rel=\"stylesheet\" type=\"text/css\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\" media=\"screen\" />\r\n                    <link rel=\"stylesheet\" type=\"text/css\" href=\"view/stylesheet/ocmax/bootstrap.fix.css\" media=\"screen\" />\r\n                    <link rel=\"stylesheet\" type=\"text/css\" href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css\" media=\"screen\" />\r\n                    <link rel=\"stylesheet\" type=\"text/css\" href=\"view/stylesheet/ocmax/bootstrap-datetimepicker.min.css\" media=\"screen\" />\r\n                    <link rel=\"stylesheet\" type=\"text/css\" href=\"view/stylesheet/ocmax/novaposhta.css\" media=\"screen\" />", "<script type=\"text/javascript\" src=\"https://code.jquery.com/ui/1.8.24/jquery-ui.min.js\"></script>");
                    $c9eafa91ebf75a03dc254d64681c5d08["header"] = preg_replace($f4375dfd5c077f29d009e04acdf12821, $faa689dc97f6cc32f85cad754b285f09, $c9eafa91ebf75a03dc254d64681c5d08["header"]);
                    $this->data = $c9eafa91ebf75a03dc254d64681c5d08;
                    $this->response->setOutput($this->render());
                }
            }
        }
    }
    public function getCNList()
    {
        if (version_compare(VERSION, "2.3", ">=")) {
            $this->load->language("extension/shipping/" . $this->extension);
        } else {
            $this->load->language("shipping/" . $this->extension);
        }
        $this->document->setTitle($this->language->get("heading_title"));
        $A8b5d100bea46e6981ac6bcb4d71dea9 = "";
        if (isset($this->request->get["filter_cn_number"])) {
            $A00e3fde64079db500472378c4178d2e = $this->request->get["filter_cn_number"];
            $A8b5d100bea46e6981ac6bcb4d71dea9 .= "&filter_cn_number=" . urlencode(html_entity_decode($this->request->get["filter_cn_number"], ENT_QUOTES, "UTF-8"));
        } else {
            $A00e3fde64079db500472378c4178d2e = "";
        }
        if (isset($this->request->get["filter_cn_type"])) {
            $aa6d65db7608d6f3be6f7b74e469e209 = $this->request->get["filter_cn_type"];
            foreach ($this->request->get["filter_cn_type"] as $d76ecc0362ae05ee6a3c85af60e6ea6e) {
                $A8b5d100bea46e6981ac6bcb4d71dea9 .= "&filter_cn_type[]=" . urlencode(html_entity_decode($d76ecc0362ae05ee6a3c85af60e6ea6e, ENT_QUOTES, "UTF-8"));
            }
        } else {
            $aa6d65db7608d6f3be6f7b74e469e209 = array();
        }
        if (isset($this->request->get["filter_departure_date_from"])) {
            $Aaa06e80fb969305048e01a7f899c2f2 = $this->request->get["filter_departure_date_from"];
            $A8b5d100bea46e6981ac6bcb4d71dea9 .= "&filter_departure_date_from=" . urlencode(html_entity_decode($this->request->get["filter_departure_date_from"], ENT_QUOTES, "UTF-8"));
        } else {
            $Aaa06e80fb969305048e01a7f899c2f2 = date("d.m.Y");
        }
        if (isset($this->request->get["filter_departure_date_to"])) {
            $e6c083e4b894a841abd9f89ba6d4a575 = $this->request->get["filter_departure_date_to"];
            $A8b5d100bea46e6981ac6bcb4d71dea9 .= "&filter_departure_date_to=" . urlencode(html_entity_decode($this->request->get["filter_departure_date_to"], ENT_QUOTES, "UTF-8"));
        } else {
            $e6c083e4b894a841abd9f89ba6d4a575 = "";
        }
        if (isset($this->request->get["page"])) {
            $fa0b32c4db3bc8d6cfa4142f0900c819 = $this->request->get["page"];
        } else {
            $fa0b32c4db3bc8d6cfa4142f0900c819 = 1;
        }
        if ($this->settings["print_format"] == "document_A4") {
            $d27738dcc0b0b549147e716b0b125333 = "printDocument";
            $D59a39d8c52ef121859577b8ff99d0c2 = "A4";
        } else {
            if ($this->settings["print_format"] == "document_A5") {
                $d27738dcc0b0b549147e716b0b125333 = "printDocument";
                $D59a39d8c52ef121859577b8ff99d0c2 = "A5";
            } else {
                if ($this->settings["print_format"] == "markings_A4") {
                    $d27738dcc0b0b549147e716b0b125333 = "printMarkings";
                    $D59a39d8c52ef121859577b8ff99d0c2 = "A4";
                    if ($this->settings["template_type"] == "html") {
                        $a7ced62402539d72f074f9744a68903b = $this->settings["print_type"];
                        $Ee478e8084c9f3ecc6882b73061d8926 = $this->settings["print_start"];
                    }
                }
            }
        }
        $c9eafa91ebf75a03dc254d64681c5d08["customized_printing"] = "https://my.novaposhta.ua/orders/" . $d27738dcc0b0b549147e716b0b125333 . "/apiKey/" . $this->novaposhta->key_api . "/type/" . $this->settings["template_type"] . "/pageFormat/" . $D59a39d8c52ef121859577b8ff99d0c2 . "/copies/" . $this->settings["number_of_copies"];
        if (isset($a7ced62402539d72f074f9744a68903b)) {
            $c9eafa91ebf75a03dc254d64681c5d08["customized_printing"] .= "/printDirection/" . $a7ced62402539d72f074f9744a68903b . "/position/" . $Ee478e8084c9f3ecc6882b73061d8926;
        }
        $c9eafa91ebf75a03dc254d64681c5d08["print_cn_pdf"] = "https://my.novaposhta.ua/orders/printDocument/apiKey/" . $this->novaposhta->key_api . "/type/pdf";
        $c9eafa91ebf75a03dc254d64681c5d08["print_cn_html"] = "https://my.novaposhta.ua/orders/printDocument/apiKey/" . $this->novaposhta->key_api . "/type/html";
        $c9eafa91ebf75a03dc254d64681c5d08["print_markings_pdf"] = "https://my.novaposhta.ua/orders/printMarkings/apiKey/" . $this->novaposhta->key_api . "/type/pdf";
        $c9eafa91ebf75a03dc254d64681c5d08["print_markings_html"] = "https://my.novaposhta.ua/orders/printMarkings/apiKey/" . $this->novaposhta->key_api . "/type/html";
        $c9eafa91ebf75a03dc254d64681c5d08["print_markings_zebra_pdf"] = "https://my.novaposhta.ua/orders/printMarkings/apiKey/" . $this->novaposhta->key_api . "/zebra/zebra/type/pdf";
        $c9eafa91ebf75a03dc254d64681c5d08["print_markings_zebra_html"] = "https://my.novaposhta.ua/orders/printMarkings/apiKey/" . $this->novaposhta->key_api . "/zebra/zebra/type/html";
        $c9eafa91ebf75a03dc254d64681c5d08["print_markings_zebra_100_100_pdf"] = "https://my.novaposhta.ua/orders/printMarking100x100/apiKey/" . $this->novaposhta->key_api . "/type/pdf";
        $c9eafa91ebf75a03dc254d64681c5d08["print_markings_zebra_100_100_html"] = "https://my.novaposhta.ua/orders/printMarking100x100/apiKey/" . $this->novaposhta->key_api . "/type/html";
        if (version_compare(VERSION, "3", ">=")) {
            $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"] = array();
            $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("text_home"), "href" => $this->url->link("common/dashboard", "user_token=" . $this->session->data["user_token"], true));
            $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("text_orders"), "href" => $this->url->link("sale/order", "user_token=" . $this->session->data["user_token"], true));
            $c9eafa91ebf75a03dc254d64681c5d08["add"] = $this->url->link("extension/shipping/novaposhta/getCNForm", "user_token=" . $this->session->data["user_token"], true);
            $c9eafa91ebf75a03dc254d64681c5d08["back_to_orders"] = $this->url->link("sale/order", "user_token=" . $this->session->data["user_token"], true);
            $c9eafa91ebf75a03dc254d64681c5d08["user_token"] = $this->session->data["user_token"];
        } else {
            if (version_compare(VERSION, "2.3", ">=")) {
                $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"] = array();
                $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("text_home"), "href" => $this->url->link("common/dashboard", "token=" . $this->session->data["token"], true));
                $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("text_orders"), "href" => $this->url->link("sale/order", "token=" . $this->session->data["token"], true));
                $c9eafa91ebf75a03dc254d64681c5d08["add"] = $this->url->link("extension/shipping/novaposhta/getCNForm", "token=" . $this->session->data["token"], true);
                $c9eafa91ebf75a03dc254d64681c5d08["back_to_orders"] = $this->url->link("sale/order", "token=" . $this->session->data["token"], true);
                $c9eafa91ebf75a03dc254d64681c5d08["token"] = $this->session->data["token"];
            } else {
                $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"] = array();
                if (version_compare(VERSION, "2", ">=")) {
                    $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("text_home"), "href" => $this->url->link("common/dashboard", "token=" . $this->session->data["token"], "SSL"));
                } else {
                    $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("text_home"), "href" => $this->url->link("common/home", "token=" . $this->session->data["token"], "SSL"));
                }
                $c9eafa91ebf75a03dc254d64681c5d08["breadcrumbs"][] = array("text" => $this->language->get("text_orders"), "href" => $this->url->link("sale/order", "token=" . $this->session->data["token"], "SSL"));
                $c9eafa91ebf75a03dc254d64681c5d08["add"] = $this->url->link("shipping/novaposhta/getCNForm", "token=" . $this->session->data["token"], "SSL");
                $c9eafa91ebf75a03dc254d64681c5d08["back_to_orders"] = $this->url->link("sale/order", "token=" . $this->session->data["token"], "SSL");
                $c9eafa91ebf75a03dc254d64681c5d08["token"] = $this->session->data["token"];
            }
        }
        if (isset($this->session->data["success"])) {
            $c9eafa91ebf75a03dc254d64681c5d08["success"] = $this->session->data["success"];
            $c9eafa91ebf75a03dc254d64681c5d08["cn_number"] = $this->session->data["cn"];
            unset($this->session->data["success"]);
            unset($this->session->data["cn"]);
        } else {
            $c9eafa91ebf75a03dc254d64681c5d08["success"] = "";
            $c9eafa91ebf75a03dc254d64681c5d08["cn_number"] = "";
        }
        if (version_compare(VERSION, "3", "<")) {
            $c9eafa91ebf75a03dc254d64681c5d08["heading_title"] = $this->language->get("heading_title");
            $c9eafa91ebf75a03dc254d64681c5d08["button_filter"] = $this->language->get("button_filter");
            $c9eafa91ebf75a03dc254d64681c5d08["button_add"] = $this->language->get("button_add");
            $c9eafa91ebf75a03dc254d64681c5d08["button_delete"] = $this->language->get("button_delete");
            $c9eafa91ebf75a03dc254d64681c5d08["button_back_to_orders"] = $this->language->get("button_back_to_orders");
            $c9eafa91ebf75a03dc254d64681c5d08["column_cn_identifier"] = $this->language->get("column_cn_identifier");
            $c9eafa91ebf75a03dc254d64681c5d08["column_cn_number"] = $this->language->get("column_cn_number");
            $c9eafa91ebf75a03dc254d64681c5d08["column_order_number"] = $this->language->get("column_order_number");
            $c9eafa91ebf75a03dc254d64681c5d08["column_create_date"] = $this->language->get("column_create_date");
            $c9eafa91ebf75a03dc254d64681c5d08["column_actual_shipping_date"] = $this->language->get("column_actual_shipping_date");
            $c9eafa91ebf75a03dc254d64681c5d08["column_preferred_shipping_date"] = $this->language->get("column_preferred_shipping_date");
            $c9eafa91ebf75a03dc254d64681c5d08["column_estimated_shipping_date"] = $this->language->get("column_estimated_shipping_date");
            $c9eafa91ebf75a03dc254d64681c5d08["column_recipient_date"] = $this->language->get("column_recipient_date");
            $c9eafa91ebf75a03dc254d64681c5d08["column_last_updated_status_date"] = $this->language->get("column_last_updated_status_date");
            $c9eafa91ebf75a03dc254d64681c5d08["column_sender"] = $this->language->get("column_sender");
            $c9eafa91ebf75a03dc254d64681c5d08["column_sender_address"] = $this->language->get("column_sender_address");
            $c9eafa91ebf75a03dc254d64681c5d08["column_recipient"] = $this->language->get("column_recipient");
            $c9eafa91ebf75a03dc254d64681c5d08["column_recipient_address"] = $this->language->get("column_recipient_address");
            $c9eafa91ebf75a03dc254d64681c5d08["column_weight"] = $this->language->get("column_weight");
            $c9eafa91ebf75a03dc254d64681c5d08["column_seats_amount"] = $this->language->get("column_seats_amount");
            $c9eafa91ebf75a03dc254d64681c5d08["column_declared_cost"] = $this->language->get("column_declared_cost");
            $c9eafa91ebf75a03dc254d64681c5d08["column_shipping_cost"] = $this->language->get("column_shipping_cost");
            $c9eafa91ebf75a03dc254d64681c5d08["column_backward_delivery"] = $this->language->get("column_backward_delivery");
            $c9eafa91ebf75a03dc254d64681c5d08["column_service_type"] = $this->language->get("column_service_type");
            $c9eafa91ebf75a03dc254d64681c5d08["column_description"] = $this->language->get("column_description");
            $c9eafa91ebf75a03dc254d64681c5d08["column_additional_information"] = $this->language->get("column_additional_information");
            $c9eafa91ebf75a03dc254d64681c5d08["column_payer_type"] = $this->language->get("column_payer_type");
            $c9eafa91ebf75a03dc254d64681c5d08["column_payment_method"] = $this->language->get("column_payment_method");
            $c9eafa91ebf75a03dc254d64681c5d08["column_departure_type"] = $this->language->get("column_departure_type");
            $c9eafa91ebf75a03dc254d64681c5d08["column_packing_number"] = $this->language->get("column_packing_number");
            $c9eafa91ebf75a03dc254d64681c5d08["column_rejection_reason"] = $this->language->get("column_rejection_reason");
            $c9eafa91ebf75a03dc254d64681c5d08["column_status"] = $this->language->get("column_status");
            $c9eafa91ebf75a03dc254d64681c5d08["column_action"] = $this->language->get("column_action");
            $c9eafa91ebf75a03dc254d64681c5d08["entry_cn_number"] = $this->language->get("entry_cn_number");
            $c9eafa91ebf75a03dc254d64681c5d08["entry_cn_type"] = $this->language->get("entry_cn_type");
            $c9eafa91ebf75a03dc254d64681c5d08["entry_departure_date"] = $this->language->get("entry_departure_date");
            $c9eafa91ebf75a03dc254d64681c5d08["entry_order_number"] = $this->language->get("entry_order_number");
            $c9eafa91ebf75a03dc254d64681c5d08["entry_print_format"] = $this->language->get("entry_print_format");
            $c9eafa91ebf75a03dc254d64681c5d08["entry_number_of_copies"] = $this->language->get("entry_number_of_copies");
            $c9eafa91ebf75a03dc254d64681c5d08["entry_template_type"] = $this->language->get("entry_template_type");
            $c9eafa91ebf75a03dc254d64681c5d08["entry_print_type"] = $this->language->get("entry_print_type");
            $c9eafa91ebf75a03dc254d64681c5d08["entry_print_start"] = $this->language->get("entry_print_start");
            $c9eafa91ebf75a03dc254d64681c5d08["text_consignment_note_list"] = $this->language->get("text_consignment_note_list");
            $c9eafa91ebf75a03dc254d64681c5d08["text_order"] = $this->language->get("text_order");
            $c9eafa91ebf75a03dc254d64681c5d08["text_edit"] = $this->language->get("text_edit");
            $c9eafa91ebf75a03dc254d64681c5d08["text_assignment_order"] = $this->language->get("text_assignment_order");
            $c9eafa91ebf75a03dc254d64681c5d08["text_print_settings"] = $this->language->get("text_print_settings");
            $c9eafa91ebf75a03dc254d64681c5d08["text_delete"] = $this->language->get("text_delete");
            $c9eafa91ebf75a03dc254d64681c5d08["text_customized_printing"] = $this->language->get("text_customized_printing");
            $c9eafa91ebf75a03dc254d64681c5d08["text_download_pdf"] = $this->language->get("text_download_pdf");
            $c9eafa91ebf75a03dc254d64681c5d08["text_print_html"] = $this->language->get("text_print_html");
            $c9eafa91ebf75a03dc254d64681c5d08["text_cn"] = $this->language->get("text_cn");
            $c9eafa91ebf75a03dc254d64681c5d08["text_mark"] = $this->language->get("text_mark");
            $c9eafa91ebf75a03dc254d64681c5d08["text_mark_zebra"] = $this->language->get("text_mark_zebra");
            $c9eafa91ebf75a03dc254d64681c5d08["text_mark_zebra_100_100"] = $this->language->get("text_mark_zebra_100_100");
            $c9eafa91ebf75a03dc254d64681c5d08["text_select"] = $this->language->get("text_select");
            $c9eafa91ebf75a03dc254d64681c5d08["text_no_results"] = $this->language->get("text_no_results");
            $c9eafa91ebf75a03dc254d64681c5d08["text_confirm"] = $this->language->get("text_confirm");
        }
        $Fe9325f259e028c569c55f5af759359b = array();
        if ($A00e3fde64079db500472378c4178d2e) {
            $Fe9325f259e028c569c55f5af759359b["IntDocNumber"] = $A00e3fde64079db500472378c4178d2e;
        }
        foreach ($aa6d65db7608d6f3be6f7b74e469e209 as $bb9a8cbc4dc13cc0572af5b2ffe7bc14) {
            $Fe9325f259e028c569c55f5af759359b[$bb9a8cbc4dc13cc0572af5b2ffe7bc14] = 1;
        }
        $A6dadb265e1d4451656b7405f75d014a = $this->novaposhta->getCNList($Aaa06e80fb969305048e01a7f899c2f2, $e6c083e4b894a841abd9f89ba6d4a575, $Fe9325f259e028c569c55f5af759359b);
        if ($A6dadb265e1d4451656b7405f75d014a && is_array($A6dadb265e1d4451656b7405f75d014a)) {
            if (version_compare(VERSION, "2.3", ">=")) {
                $this->load->model("extension/shipping/" . $this->extension);
                $Cbb660b5f9a8847e2e0f0b3f98ecf166 = "model_extension_shipping_novaposhta";
            } else {
                $this->load->model("shipping/" . $this->extension);
                $Cbb660b5f9a8847e2e0f0b3f98ecf166 = "model_shipping_novaposhta";
            }
            $Ac557347eab62d70de912f3a6dc3c847 = $this->novaposhta->getReferences();
            foreach ($Ac557347eab62d70de912f3a6dc3c847 as $f3e3e72bc9710ac63cb5eec4b306fc43 => $E800fb2f2c0c016c454dc9b599fd7f10) {
                foreach ($E800fb2f2c0c016c454dc9b599fd7f10 as $ce260eb27a74d9377d3595069458da1b => $d76ecc0362ae05ee6a3c85af60e6ea6e) {
                    if (isset($d76ecc0362ae05ee6a3c85af60e6ea6e["Ref"])) {
                        $Ac557347eab62d70de912f3a6dc3c847[$f3e3e72bc9710ac63cb5eec4b306fc43][$d76ecc0362ae05ee6a3c85af60e6ea6e["Ref"]] = $d76ecc0362ae05ee6a3c85af60e6ea6e["Description"];
                        unset($Ac557347eab62d70de912f3a6dc3c847[$f3e3e72bc9710ac63cb5eec4b306fc43][$ce260eb27a74d9377d3595069458da1b]);
                    }
                }
            }
            foreach ($A6dadb265e1d4451656b7405f75d014a as $ce260eb27a74d9377d3595069458da1b => $C944c3fb3fed36ba670b6e01b7aa2f4d) {
                $F526e5d763363d0546574add5c29bb26 = $this->{$Cbb660b5f9a8847e2e0f0b3f98ecf166}->getOrderByDocumentNumber($C944c3fb3fed36ba670b6e01b7aa2f4d["IntDocNumber"]);
                if (!$this->settings["display_all_consignments"] && !$F526e5d763363d0546574add5c29bb26) {
                    unset($A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]);
                } else {
                    if ($F526e5d763363d0546574add5c29bb26) {
                        if (version_compare(VERSION, "3", ">=")) {
                            $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["order"] = $this->url->link("sale/order/info", "user_token=" . $this->session->data["user_token"] . "&order_id=" . $F526e5d763363d0546574add5c29bb26["order_id"], true);
                        } else {
                            if (version_compare(VERSION, "2.3", ">=")) {
                                $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["order"] = $this->url->link("sale/order/info", "token=" . $this->session->data["token"] . "&order_id=" . $F526e5d763363d0546574add5c29bb26["order_id"], true);
                            } else {
                                $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["order"] = $this->url->link("sale/order/info", "token=" . $this->session->data["token"] . "&order_id=" . $F526e5d763363d0546574add5c29bb26["order_id"], "SSL");
                            }
                        }
                        $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["order_id"] = $F526e5d763363d0546574add5c29bb26["order_id"];
                    }
                    $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["create_date"] = date($this->language->get("datetime_format"), strtotime($C944c3fb3fed36ba670b6e01b7aa2f4d["CreateTime"]));
                    $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["actual_shipping_date"] = date($this->language->get("datetime_format"), strtotime($C944c3fb3fed36ba670b6e01b7aa2f4d["DateTime"]));
                    if (strtotime($C944c3fb3fed36ba670b6e01b7aa2f4d["PreferredDeliveryDate"])) {
                        $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["preferred_shipping_date"] = date($this->language->get("datetime_format"), strtotime($C944c3fb3fed36ba670b6e01b7aa2f4d["PreferredDeliveryDate"]));
                    } else {
                        $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["preferred_shipping_date"] = "";
                    }
                    $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["estimated_shipping_date"] = date($this->language->get("date_format_short"), strtotime($C944c3fb3fed36ba670b6e01b7aa2f4d["EstimatedDeliveryDate"]));
                    if (strtotime($C944c3fb3fed36ba670b6e01b7aa2f4d["RecipientDateTime"])) {
                        $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["recipient_date"] = date($this->language->get("datetime_format"), strtotime($C944c3fb3fed36ba670b6e01b7aa2f4d["RecipientDateTime"]));
                    } else {
                        $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["recipient_date"] = "";
                    }
                    $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["last_updated_status_date"] = date($this->language->get("datetime_format"), strtotime($C944c3fb3fed36ba670b6e01b7aa2f4d["DateLastUpdatedStatus"]));
                    $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["sender"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["SenderDescription"];
                    if ($C944c3fb3fed36ba670b6e01b7aa2f4d["SendersPhone"]) {
                        $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["sender"] .= " " . $C944c3fb3fed36ba670b6e01b7aa2f4d["SendersPhone"];
                    }
                    $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["sender_address"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["CitySenderDescription"] . ", " . $C944c3fb3fed36ba670b6e01b7aa2f4d["SenderAddressDescription"];
                    $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["recipient"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["RecipientDescription"] . ": " . $C944c3fb3fed36ba670b6e01b7aa2f4d["RecipientContactPerson"] . " " . $C944c3fb3fed36ba670b6e01b7aa2f4d["RecipientContactPhone"];
                    $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["recipient_address"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["CityRecipientDescription"] . ", " . $C944c3fb3fed36ba670b6e01b7aa2f4d["RecipientAddressDescription"];
                    $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["declared_cost"] = $this->currency->format($C944c3fb3fed36ba670b6e01b7aa2f4d["Cost"], "UAH", 1);
                    $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["shipping_cost"] = $this->currency->format($C944c3fb3fed36ba670b6e01b7aa2f4d["CostOnSite"], "UAH", 1);
                    if ($C944c3fb3fed36ba670b6e01b7aa2f4d["BackwardDeliveryCargoType"]) {
                        $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["backward_delivery"] = $C944c3fb3fed36ba670b6e01b7aa2f4d["BackwardDeliveryCargoType"] . ": " . $this->currency->format($C944c3fb3fed36ba670b6e01b7aa2f4d["BackwardDeliverySum"], "UAH", 1);
                    } else {
                        $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["backward_delivery"] = "";
                    }
                    $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["service_type"] = $Ac557347eab62d70de912f3a6dc3c847["service_types"][$C944c3fb3fed36ba670b6e01b7aa2f4d["ServiceType"]];
                    $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["payer_type"] = $Ac557347eab62d70de912f3a6dc3c847["payer_types"][$C944c3fb3fed36ba670b6e01b7aa2f4d["PayerType"]];
                    $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["payment_method"] = $Ac557347eab62d70de912f3a6dc3c847["payment_types"][$C944c3fb3fed36ba670b6e01b7aa2f4d["PaymentMethod"]];
                    $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["departure_type"] = $Ac557347eab62d70de912f3a6dc3c847["cargo_types"][$C944c3fb3fed36ba670b6e01b7aa2f4d["CargoType"]];
                    $A6dadb265e1d4451656b7405f75d014a[$ce260eb27a74d9377d3595069458da1b]["status"] = "(" . $this->language->get("entry_code") . " " . $C944c3fb3fed36ba670b6e01b7aa2f4d["StateId"] . ") " . $C944c3fb3fed36ba670b6e01b7aa2f4d["StateName"];
                }
            }
            $fdab221f70ff8d9c235832fd1f43b028 = count($A6dadb265e1d4451656b7405f75d014a);
            $A6dadb265e1d4451656b7405f75d014a = array_slice($A6dadb265e1d4451656b7405f75d014a, ($fa0b32c4db3bc8d6cfa4142f0900c819 - 1) * $this->config->get("config_limit_admin"), $this->config->get("config_limit_admin"));
        } else {
            $fdab221f70ff8d9c235832fd1f43b028 = 0;
        }
        $c9eafa91ebf75a03dc254d64681c5d08["cns"] = $A6dadb265e1d4451656b7405f75d014a;
        $fd851ce2d905e94afab60cd3b62acf88 = new Pagination();
        $fd851ce2d905e94afab60cd3b62acf88->total = $fdab221f70ff8d9c235832fd1f43b028;
        $fd851ce2d905e94afab60cd3b62acf88->page = $fa0b32c4db3bc8d6cfa4142f0900c819;
        if (version_compare(VERSION, "2", ">=")) {
            $fd851ce2d905e94afab60cd3b62acf88->limit = $this->config->get("config_limit_admin");
            if (version_compare(VERSION, "3", ">=")) {
                $fd851ce2d905e94afab60cd3b62acf88->url = $this->url->link("extension/shipping/novaposhta/getCNList", "user_token=" . $this->session->data["user_token"] . $A8b5d100bea46e6981ac6bcb4d71dea9 . "&page={page}", true);
            } else {
                if (version_compare(VERSION, "2.3", ">=")) {
                    $fd851ce2d905e94afab60cd3b62acf88->url = $this->url->link("extension/shipping/novaposhta/getCNList", "token=" . $this->session->data["token"] . $A8b5d100bea46e6981ac6bcb4d71dea9 . "&page={page}", true);
                } else {
                    $fd851ce2d905e94afab60cd3b62acf88->url = $this->url->link("shipping/novaposhta/getCNList", "token=" . $this->session->data["token"] . $A8b5d100bea46e6981ac6bcb4d71dea9 . "&page={page}", "SSL");
                }
            }
            $c9eafa91ebf75a03dc254d64681c5d08["results"] = sprintf($this->language->get("text_pagination"), $fdab221f70ff8d9c235832fd1f43b028 ? ($fa0b32c4db3bc8d6cfa4142f0900c819 - 1) * $this->config->get("config_limit_admin") + 1 : 0, $fdab221f70ff8d9c235832fd1f43b028 - $this->config->get("config_limit_admin") < ($fa0b32c4db3bc8d6cfa4142f0900c819 - 1) * $this->config->get("config_limit_admin") ? $fdab221f70ff8d9c235832fd1f43b028 : ($fa0b32c4db3bc8d6cfa4142f0900c819 - 1) * $this->config->get("config_limit_admin") + $this->config->get("config_limit_admin"), $fdab221f70ff8d9c235832fd1f43b028, ceil($fdab221f70ff8d9c235832fd1f43b028 / $this->config->get("config_limit_admin")));
        } else {
            $fd851ce2d905e94afab60cd3b62acf88->limit = $this->config->get("config_admin_limit");
            $fd851ce2d905e94afab60cd3b62acf88->text = $this->language->get("text_pagination");
            $fd851ce2d905e94afab60cd3b62acf88->url = $this->url->link("shipping/novaposhta/getCNList", "token=" . $this->session->data["token"] . $A8b5d100bea46e6981ac6bcb4d71dea9 . "&page={page}", "SSL");
        }
        $c9eafa91ebf75a03dc254d64681c5d08["pagination"] = $fd851ce2d905e94afab60cd3b62acf88->render();
        $c9eafa91ebf75a03dc254d64681c5d08["key_api"] = $this->novaposhta->key_api;
        $c9eafa91ebf75a03dc254d64681c5d08["filters"] = array("RedeliveryMoney" => $this->language->get("text_redelivery_money"), "UnassembledCargo" => $this->language->get("text_unassembled_cargo"));
        $c9eafa91ebf75a03dc254d64681c5d08["print_formats"] = array("document_A4" => $this->language->get("text_cn_a4"), "document_A5" => $this->language->get("text_cn_a5"), "markings_A4" => $this->language->get("text_mark"));
        $c9eafa91ebf75a03dc254d64681c5d08["template_types"] = array("html" => $this->language->get("text_html"), "pdf" => $this->language->get("text_pdf"));
        $c9eafa91ebf75a03dc254d64681c5d08["print_types"] = array("horPrint" => $this->language->get("text_horizontally"), "verPrint" => $this->language->get("text_vertically"));
        if (!empty($this->settings["consignment_displayed_information"])) {
            $c9eafa91ebf75a03dc254d64681c5d08["displayed_information"] = $this->settings["consignment_displayed_information"];
        } else {
            $c9eafa91ebf75a03dc254d64681c5d08["displayed_information"] = array();
        }
        $c9eafa91ebf75a03dc254d64681c5d08["filter_cn_number"] = $A00e3fde64079db500472378c4178d2e;
        $c9eafa91ebf75a03dc254d64681c5d08["filter_cn_type"] = $aa6d65db7608d6f3be6f7b74e469e209;
        $c9eafa91ebf75a03dc254d64681c5d08["filter_departure_date_from"] = $Aaa06e80fb969305048e01a7f899c2f2;
        $c9eafa91ebf75a03dc254d64681c5d08["filter_departure_date_to"] = $e6c083e4b894a841abd9f89ba6d4a575;
        $c9eafa91ebf75a03dc254d64681c5d08["v"] = $this->version;
        if (version_compare(VERSION, "2.3", ">=")) {
            $c9eafa91ebf75a03dc254d64681c5d08["header"] = $this->load->controller("common/header");
            $c9eafa91ebf75a03dc254d64681c5d08["column_left"] = $this->load->controller("common/column_left");
            $c9eafa91ebf75a03dc254d64681c5d08["footer"] = $this->load->controller("common/footer");
            $this->response->setOutput($this->load->view("extension/shipping/" . $this->extension . "_cn_list", $c9eafa91ebf75a03dc254d64681c5d08));
        } else {
            if (version_compare(VERSION, "2", ">=")) {
                $c9eafa91ebf75a03dc254d64681c5d08["header"] = $this->load->controller("common/header");
                $c9eafa91ebf75a03dc254d64681c5d08["column_left"] = $this->load->controller("common/column_left");
                $c9eafa91ebf75a03dc254d64681c5d08["footer"] = $this->load->controller("common/footer");
                $this->response->setOutput($this->load->view("shipping/" . $this->extension . "_cn_list.tpl", $c9eafa91ebf75a03dc254d64681c5d08));
            } else {
                $c9eafa91ebf75a03dc254d64681c5d08["header"] = $this->getChild("common/header");
                $c9eafa91ebf75a03dc254d64681c5d08["footer"] = $this->getChild("common/footer");
                $this->template = "shipping/" . $this->extension . "_cn_list.tpl";
                $f4375dfd5c077f29d009e04acdf12821 = array("/<script type=\"text\\/javascript\" src=\"view\\/javascript\\/jquery\\/jquery-(.+)\\.min\\.js\"><\\/script>/", "/<script type=\"text\\/javascript\" src=\"view\\/javascript\\/jquery\\/ui\\/jquery-ui-(.+)\\.js\"><\\/script>/");
                $faa689dc97f6cc32f85cad754b285f09 = array("<script type=\"text/javascript\" src=\"https://code.jquery.com/jquery-2.1.1.min.js\"></script>\r\n                 <script type=\"text/javascript\" src=\"https://code.jquery.com/jquery-migrate-1.2.1.min.js\"></script>\r\n                 <script type=\"text/javascript\" src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>\r\n                 <script type=\"text/javascript\" src=\"view/javascript/ocmax/moment.min.js\"></script>\r\n                 <script type=\"text/javascript\" src=\"view/javascript/ocmax/bootstrap-datetimepicker.min.js\"></script>\r\n                 <script type=\"text/javascript\" src=\"view/javascript/ocmax/ocmax.js\"></script>\r\n                 <link rel=\"stylesheet\" type=\"text/css\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\" media=\"screen\" />\r\n                 <link rel=\"stylesheet\" type=\"text/css\" href=\"view/stylesheet/ocmax/bootstrap.fix.css\" media=\"screen\" />\r\n                 <link rel=\"stylesheet\" type=\"text/css\" href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css\" media=\"screen\" />\r\n                 <link rel=\"stylesheet\" type=\"text/css\" href=\"view/stylesheet/ocmax/bootstrap-datetimepicker.min.css\" media=\"screen\" />\r\n                 <link rel=\"stylesheet\" type=\"text/css\" href=\"view/stylesheet/ocmax/novaposhta.css\" media=\"screen\" />", "<script type=\"text/javascript\" src=\"https://code.jquery.com/ui/1.8.24/jquery-ui.min.js\"></script>");
                $c9eafa91ebf75a03dc254d64681c5d08["header"] = preg_replace($f4375dfd5c077f29d009e04acdf12821, $faa689dc97f6cc32f85cad754b285f09, $c9eafa91ebf75a03dc254d64681c5d08["header"]);
                $this->data = $c9eafa91ebf75a03dc254d64681c5d08;
                $this->response->setOutput($this->render());
            }
        }
    }
    public function saveCN()
    {
        if (version_compare(VERSION, "2.3", ">=")) {
            $this->load->language("extension/shipping/" . $this->extension);
            $this->load->model("extension/shipping/" . $this->extension);
            $Cbb660b5f9a8847e2e0f0b3f98ecf166 = "model_extension_shipping_novaposhta";
        } else {
            $this->load->language("shipping/" . $this->extension);
            $this->load->model("shipping/" . $this->extension);
            $Cbb660b5f9a8847e2e0f0b3f98ecf166 = "model_shipping_novaposhta";
        }
        if ($this->request->server["REQUEST_METHOD"] == "POST" && $this->validate() && $this->validateCNForm()) {
            $d8b31b4a0a7220af68c8f1a6afc103bf = array("NewAddress" => 1, "Sender" => $this->request->post["sender"], "ContactSender" => $this->request->post["sender_contact_person"], "SendersPhone" => $this->request->post["sender_contact_person_phone"], "CitySender" => $this->request->post["sender_city"], "SenderAddress" => $this->request->post["sender_address"], "Recipient" => "", "RecipientsPhone" => $this->request->post["recipient_contact_person_phone"], "CargoType" => $this->request->post["departure_type"], "SeatsAmount" => $this->request->post["seats_amount"], "Cost" => $this->request->post["declared_cost"], "Description" => $this->request->post["departure_description"], "PayerType" => $this->request->post["delivery_payer"], "PaymentMethod" => $this->request->post["payment_type"], "DateTime" => $this->request->post["departure_date"]);
            if ($this->request->post["recipient_address_type"] == "doors") {
                $B7bfea3c607b7657a2fb2a405e03cbcd = "Doors";
            } else {
                $B7bfea3c607b7657a2fb2a405e03cbcd = "Warehouse";
            }
            if ($this->settings["sender_address_type"]) {
                $d8b31b4a0a7220af68c8f1a6afc103bf["ServiceType"] = $this->settings["sender_address_type"] . $B7bfea3c607b7657a2fb2a405e03cbcd;
            } else {
                $d8b31b4a0a7220af68c8f1a6afc103bf["ServiceType"] = "Warehouse" . $B7bfea3c607b7657a2fb2a405e03cbcd;
            }
            if (!$this->request->post["recipient"]) {
                $a0f2f3c31977da4a35aa8aedd72925d6 = explode(" ", preg_replace("/ {2,}/", " ", trim($this->request->post["recipient_name"])), 2);
                if (empty($a0f2f3c31977da4a35aa8aedd72925d6[1])) {
                    $a0f2f3c31977da4a35aa8aedd72925d6[1] = $a0f2f3c31977da4a35aa8aedd72925d6[0];
                    $a0f2f3c31977da4a35aa8aedd72925d6[0] = "ПП";
                }
                $A5f56d45e17cbc4ec2e0b78ffc5aecba = $this->novaposhta->getCounterparties("Recipient", $a0f2f3c31977da4a35aa8aedd72925d6[1]);
                if ($A5f56d45e17cbc4ec2e0b78ffc5aecba) {
                    $b4a351ecbb0ef5e2360cc5e3119bd6af = array_shift($A5f56d45e17cbc4ec2e0b78ffc5aecba);
                } else {
                    $ab6c55bdc161a5ab90a544c52d48825d = $this->getOwnreshipForm($a0f2f3c31977da4a35aa8aedd72925d6[0]);
                    $ee3af1e77cdf985a4b786264e69fc44a = array("CityRef" => $this->request->post["recipient_city"], "FirstName" => $a0f2f3c31977da4a35aa8aedd72925d6[1], "CounterpartyType" => "Organization", "CounterpartyProperty" => "Recipient", "OwnershipForm" => $ab6c55bdc161a5ab90a544c52d48825d["Ref"]);
                    $b4a351ecbb0ef5e2360cc5e3119bd6af = $this->novaposhta->saveCounterparties($ee3af1e77cdf985a4b786264e69fc44a);
                }
                if ($b4a351ecbb0ef5e2360cc5e3119bd6af) {
                    $d8b31b4a0a7220af68c8f1a6afc103bf["Recipient"] = $b4a351ecbb0ef5e2360cc5e3119bd6af["Ref"];
                }
            } else {
                $d8b31b4a0a7220af68c8f1a6afc103bf["Recipient"] = $this->request->post["recipient"];
            }
            if ($this->request->post["recipient_address_type"] != "doors") {
                $d8b31b4a0a7220af68c8f1a6afc103bf["CityRecipient"] = $this->request->post["recipient_city"];
                $d8b31b4a0a7220af68c8f1a6afc103bf["RecipientAddress"] = $this->request->post["recipient_warehouse"];
            } else {
                $d5a7e8ddb93fbfd48cdc155c1583810a = $this->novaposhta->getCounterpartyAddresses($d8b31b4a0a7220af68c8f1a6afc103bf["Recipient"], "Recipient", $this->request->post["recipient_city"]);
                if ($d5a7e8ddb93fbfd48cdc155c1583810a) {
                    foreach ($d5a7e8ddb93fbfd48cdc155c1583810a as $ce260eb27a74d9377d3595069458da1b => $d76ecc0362ae05ee6a3c85af60e6ea6e) {
                        if ($d76ecc0362ae05ee6a3c85af60e6ea6e["BuildingDescription"] == $this->request->post["recipient_house"] && (!$this->request->post["recipient_flat"] && mb_stripos($d76ecc0362ae05ee6a3c85af60e6ea6e["Description"], "кв.") === false || $this->request->post["recipient_flat"] && mb_stripos($d76ecc0362ae05ee6a3c85af60e6ea6e["Description"], "кв. " . $this->request->post["recipient_flat"]) !== false)) {
                            $d8b31b4a0a7220af68c8f1a6afc103bf["CityRecipient"] = $this->request->post["recipient_city"];
                            $d8b31b4a0a7220af68c8f1a6afc103bf["RecipientAddress"] = $ce260eb27a74d9377d3595069458da1b;
                            break;
                        }
                    }
                }
                if (empty($d8b31b4a0a7220af68c8f1a6afc103bf["RecipientAddress"])) {
                    $d8b31b4a0a7220af68c8f1a6afc103bf["RecipientArea"] = $this->request->post["recipient_region_name"];
                    $d8b31b4a0a7220af68c8f1a6afc103bf["RecipientAreaRegions"] = $this->request->post["recipient_district_name"];
                    $d8b31b4a0a7220af68c8f1a6afc103bf["RecipientCityName"] = $this->request->post["recipient_city_name"];
                    $d8b31b4a0a7220af68c8f1a6afc103bf["RecipientAddressName"] = $this->request->post["recipient_street_name"];
                    $d8b31b4a0a7220af68c8f1a6afc103bf["RecipientHouse"] = $this->request->post["recipient_house"];
                    $d8b31b4a0a7220af68c8f1a6afc103bf["RecipientFlat"] = $this->request->post["recipient_flat"];
                }
            }
            if (isset($b4a351ecbb0ef5e2360cc5e3119bd6af["CounterpartyType"]) && $b4a351ecbb0ef5e2360cc5e3119bd6af["CounterpartyType"] == "Organization") {
                $d8b31b4a0a7220af68c8f1a6afc103bf["RecipientName"] = $b4a351ecbb0ef5e2360cc5e3119bd6af["FirstName"];
                $d8b31b4a0a7220af68c8f1a6afc103bf["RecipientContactName"] = preg_replace("/ {2,}/", " ", mb_convert_case(trim($this->request->post["recipient_contact_person"]), MB_CASE_TITLE, "UTF-8"));
                $d8b31b4a0a7220af68c8f1a6afc103bf["RecipientType"] = $b4a351ecbb0ef5e2360cc5e3119bd6af["CounterpartyType"];
                if (!empty($b4a351ecbb0ef5e2360cc5e3119bd6af["OwnershipForm"])) {
                    $d8b31b4a0a7220af68c8f1a6afc103bf["OwnershipForm"] = $b4a351ecbb0ef5e2360cc5e3119bd6af["OwnershipForm"];
                } else {
                    if (!empty($b4a351ecbb0ef5e2360cc5e3119bd6af["OwnershipFormRef"])) {
                        $d8b31b4a0a7220af68c8f1a6afc103bf["OwnershipForm"] = $b4a351ecbb0ef5e2360cc5e3119bd6af["OwnershipFormRef"];
                    }
                }
            } else {
                $d8b31b4a0a7220af68c8f1a6afc103bf["RecipientName"] = preg_replace("/ {2,}/", " ", mb_convert_case(trim($this->request->post["recipient_contact_person"]), MB_CASE_TITLE, "UTF-8"));
                $d8b31b4a0a7220af68c8f1a6afc103bf["RecipientType"] = "PrivatePerson";
            }
            if (isset($this->request->post["third_person"])) {
                $d8b31b4a0a7220af68c8f1a6afc103bf["ThirdPerson"] = $this->request->post["third_person"];
            }
            if (isset($this->request->post["recipient_warehouse_name"]) && preg_match("/поштомат|почтомат/ui", $this->request->post["recipient_warehouse_name"]) && $this->request->post["departure_type"] == "Parcel") {
                $d8b31b4a0a7220af68c8f1a6afc103bf["OptionsSeat"][] = array("volumetricVolume" => $this->request->post["volume_general"], "volumetricWidth" => $this->request->post["width"], "volumetricLength" => $this->request->post["length"], "volumetricHeight" => $this->request->post["height"], "weight" => $this->request->post["weight"], "volumetricWeight" => $this->request->post["volume_weight"]);
            } else {
                if ($this->request->post["departure_type"] == "TiresWheels") {
                    foreach ($this->request->post["tires_and_wheels"] as $b0bfd53c63611379e867505b1865834a => $a59283ff30fa14d407d77ecd9c4a2e46) {
                        if ($a59283ff30fa14d407d77ecd9c4a2e46) {
                            $d8b31b4a0a7220af68c8f1a6afc103bf["CargoDetails"][] = array("CargoDescription" => $b0bfd53c63611379e867505b1865834a, "Amount" => $a59283ff30fa14d407d77ecd9c4a2e46);
                        }
                    }
                } else {
                    if (isset($this->request->post["weight"])) {
                        $d8b31b4a0a7220af68c8f1a6afc103bf["Weight"] = $this->request->post["weight"];
                    }
                    if (isset($this->request->post["volume_general"])) {
                        $d8b31b4a0a7220af68c8f1a6afc103bf["VolumeGeneral"] = $this->request->post["volume_general"];
                    }
                    if (isset($this->request->post["volume_weight"])) {
                        $d8b31b4a0a7220af68c8f1a6afc103bf["VolumeWeight"] = $this->request->post["volume_weight"];
                    }
                }
            }
            if (!empty($this->request->post["redbox_barcode"])) {
                $d8b31b4a0a7220af68c8f1a6afc103bf["RedBoxBarcode"] = $this->request->post["redbox_barcode"];
            }
            if ($this->request->post["backward_delivery"] && $this->request->post["backward_delivery"] != "N") {
                if ($this->request->post["backward_delivery"] == "Money") {
                    $d8b31b4a0a7220af68c8f1a6afc103bf["BackwardDeliveryData"][0] = array("CargoType" => $this->request->post["backward_delivery"], "PayerType" => $this->request->post["backward_delivery_payer"], "RedeliveryString" => $this->request->post["backward_delivery_total"]);
                    if ($this->request->post["money_transfer_method"] == "to_payment_card") {
                        $d8b31b4a0a7220af68c8f1a6afc103bf["BackwardDeliveryData"][0]["PaymentCard"] = $this->request->post["payment_card"];
                    }
                }
            }
            if (!empty($this->request->post["payment_control"])) {
                $d8b31b4a0a7220af68c8f1a6afc103bf["AfterpaymentOnGoodsCost"] = $this->request->post["payment_control"];
            }
            if (!empty($this->request->post["preferred_delivery_date"])) {
                $d8b31b4a0a7220af68c8f1a6afc103bf["PreferredDeliveryDate"] = $this->request->post["preferred_delivery_date"];
            }
            if (!empty($this->request->post["time_interval"])) {
                $d8b31b4a0a7220af68c8f1a6afc103bf["TimeInterval"] = $this->request->post["time_interval"];
            }
            if (!empty($this->request->post["sales_order_number"])) {
                $d8b31b4a0a7220af68c8f1a6afc103bf["InfoRegClientBarcodes"] = $this->request->post["sales_order_number"];
            }
            if (!empty($this->request->post["packing_number"])) {
                $d8b31b4a0a7220af68c8f1a6afc103bf["PackingNumber"] = $this->request->post["packing_number"];
            }
            if (!empty($this->request->post["additional_information"])) {
                $d8b31b4a0a7220af68c8f1a6afc103bf["AdditionalInformation"] = $this->request->post["additional_information"];
            }
            if (isset($this->request->post["rise_on_floor"])) {
                $d8b31b4a0a7220af68c8f1a6afc103bf["NumberOfFloorsLifting"] = $this->request->post["rise_on_floor"];
            }
            if (isset($this->request->post["elevator"])) {
                $d8b31b4a0a7220af68c8f1a6afc103bf["Elevator"] = 1;
            }
            if (!empty($this->request->get["cn_ref"])) {
                $d8b31b4a0a7220af68c8f1a6afc103bf["Ref"] = $this->request->get["cn_ref"];
            }
            $A5f56d45e17cbc4ec2e0b78ffc5aecba = $this->novaposhta->saveCN($d8b31b4a0a7220af68c8f1a6afc103bf);
            if ($A5f56d45e17cbc4ec2e0b78ffc5aecba) {
                if (!empty($this->request->get["order_id"])) {
                    $this->{$Cbb660b5f9a8847e2e0f0b3f98ecf166}->addCNToOrder($this->request->get["order_id"], $A5f56d45e17cbc4ec2e0b78ffc5aecba["IntDocNumber"], $A5f56d45e17cbc4ec2e0b78ffc5aecba["Ref"]);
                }
            } else {
                $this->error["warning"] = $this->novaposhta->error;
                $this->error["warning"][] = $this->language->get("error_cn_save");
            }
        }
        if ($this->error) {
            $b9187c230b7a1f38e532c8dd391a0bff = $this->error;
        } else {
            if (!empty($A5f56d45e17cbc4ec2e0b78ffc5aecba["IntDocNumber"])) {
                $this->session->data["cn"] = $A5f56d45e17cbc4ec2e0b78ffc5aecba["IntDocNumber"];
                $this->session->data["success"] = $this->language->get("text_cn_success_save");
                $b9187c230b7a1f38e532c8dd391a0bff["success"] = $this->request->post["departure_date"];
            }
        }
        $this->response->addHeader("Content-Type: application/json");
        $this->response->setOutput(json_encode($b9187c230b7a1f38e532c8dd391a0bff));
    }
    public function deleteCN()
    {
        if (version_compare(VERSION, "2.3", ">=")) {
            $this->load->language("extension/shipping/" . $this->extension);
            $this->load->model("extension/shipping/" . $this->extension);
            $Cbb660b5f9a8847e2e0f0b3f98ecf166 = "model_extension_shipping_novaposhta";
        } else {
            $this->load->language("shipping/" . $this->extension);
            $this->load->model("shipping/" . $this->extension);
            $Cbb660b5f9a8847e2e0f0b3f98ecf166 = "model_shipping_novaposhta";
        }
        $b9187c230b7a1f38e532c8dd391a0bff = array();
        if ($this->validate() && isset($this->request->post["refs"])) {
            if (!empty($this->request->post["orders"])) {
                $this->{$Cbb660b5f9a8847e2e0f0b3f98ecf166}->deleteCNFromOrder($this->request->post["orders"]);
            }
            $c9eafa91ebf75a03dc254d64681c5d08 = $this->novaposhta->deleteCN($this->request->post["refs"]);
            if ($c9eafa91ebf75a03dc254d64681c5d08) {
                $b9187c230b7a1f38e532c8dd391a0bff["success"]["refs"] = $c9eafa91ebf75a03dc254d64681c5d08;
                $b9187c230b7a1f38e532c8dd391a0bff["success"]["text"] = $this->language->get("text_success_delete");
            } else {
                $b9187c230b7a1f38e532c8dd391a0bff["warning"] = $this->novaposhta->error;
                $b9187c230b7a1f38e532c8dd391a0bff["warning"][] = $this->language->get("error_delete");
            }
        } else {
            $b9187c230b7a1f38e532c8dd391a0bff["warning"][] = $this->error["warning"];
        }
        $this->response->addHeader("Content-Type: application/json");
        $this->response->setOutput(json_encode($b9187c230b7a1f38e532c8dd391a0bff));
    }
    public function addCNToOrder()
    {
        if (version_compare(VERSION, "2.3", ">=")) {
            $this->load->language("extension/shipping/" . $this->extension);
            $this->load->model("extension/shipping/" . $this->extension);
            $Cbb660b5f9a8847e2e0f0b3f98ecf166 = "model_extension_shipping_novaposhta";
        } else {
            $this->load->language("shipping/" . $this->extension);
            $this->load->model("shipping/" . $this->extension);
            $Cbb660b5f9a8847e2e0f0b3f98ecf166 = "model_shipping_novaposhta";
        }
        $b9187c230b7a1f38e532c8dd391a0bff = array();
        if ($this->validate() && isset($this->request->post["order_id"])) {
            if (isset($this->request->post["cn_number"]) && isset($this->request->post["cn_ref"])) {
                $A5f56d45e17cbc4ec2e0b78ffc5aecba = $this->{$Cbb660b5f9a8847e2e0f0b3f98ecf166}->addCNToOrder($this->request->post["order_id"], $this->request->post["cn_number"], $this->request->post["cn_ref"]);
            } else {
                $c99432053ab7dccc499891358d5bdd24 = $this->novaposhta->getCNList("", "", array("IntDocNumber" => $this->request->post["cn_number"]));
                if (isset($c99432053ab7dccc499891358d5bdd24[0])) {
                    $A5f56d45e17cbc4ec2e0b78ffc5aecba = $this->{$Cbb660b5f9a8847e2e0f0b3f98ecf166}->addCNToOrder($this->request->post["order_id"], $c99432053ab7dccc499891358d5bdd24[0]["IntDocNumber"], $c99432053ab7dccc499891358d5bdd24[0]["Ref"]);
                }
                if (empty($A5f56d45e17cbc4ec2e0b78ffc5aecba)) {
                    $fb7f1ce28c98e93bad0c8b244e7c442b = $this->novaposhta->tracking(array(array("DocumentNumber" => $this->request->post["cn_number"], "Phone" => "")));
                    if ($fb7f1ce28c98e93bad0c8b244e7c442b) {
                        $A5f56d45e17cbc4ec2e0b78ffc5aecba = $this->{$Cbb660b5f9a8847e2e0f0b3f98ecf166}->addCNToOrder($this->request->post["order_id"], $this->request->post["cn_number"]);
                    }
                }
            }
            if (empty($A5f56d45e17cbc4ec2e0b78ffc5aecba)) {
                $b9187c230b7a1f38e532c8dd391a0bff["error"] = $this->language->get("error_cn_assignment");
            } else {
                $b9187c230b7a1f38e532c8dd391a0bff["success"] = $this->language->get("text_cn_success_assignment");
            }
        } else {
            $b9187c230b7a1f38e532c8dd391a0bff["error"] = $this->error["warning"];
        }
        $this->response->addHeader("Content-Type: application/json");
        $this->response->setOutput(json_encode($b9187c230b7a1f38e532c8dd391a0bff));
    }
    public function deleteCNFromOrder()
    {
        if (version_compare(VERSION, "2.3", ">=")) {
            $this->load->language("extension/shipping/" . $this->extension);
            $this->load->model("extension/shipping/" . $this->extension);
            $Cbb660b5f9a8847e2e0f0b3f98ecf166 = "model_extension_shipping_novaposhta";
        } else {
            $this->load->language("shipping/" . $this->extension);
            $this->load->model("shipping/" . $this->extension);
            $Cbb660b5f9a8847e2e0f0b3f98ecf166 = "model_shipping_novaposhta";
        }
        $b9187c230b7a1f38e532c8dd391a0bff = array();
        if ($this->validate() && isset($this->request->post["order_id"])) {
            $F526e5d763363d0546574add5c29bb26 = $this->{$Cbb660b5f9a8847e2e0f0b3f98ecf166}->getOrder($this->request->post["order_id"]);
            if (!empty($F526e5d763363d0546574add5c29bb26["novaposhta_cn_number"])) {
                $this->novaposhta->deleteCN(array($F526e5d763363d0546574add5c29bb26["novaposhta_cn_ref"]));
                $this->{$Cbb660b5f9a8847e2e0f0b3f98ecf166}->deleteCNFromOrder(array($this->request->post["order_id"]));
                $b9187c230b7a1f38e532c8dd391a0bff["success"] = $this->language->get("text_success_delete");
            } else {
                $b9187c230b7a1f38e532c8dd391a0bff["error"] = $this->language->get("error_delete");
            }
        } else {
            $b9187c230b7a1f38e532c8dd391a0bff["error"] = $this->error["warning"];
        }
        $this->response->addHeader("Content-Type: application/json");
        $this->response->setOutput(json_encode($b9187c230b7a1f38e532c8dd391a0bff));
    }
    public function verifyingAPIaccess()
    {
        if (version_compare(VERSION, "2.3", ">=")) {
            $this->load->language("extension/shipping/" . $this->extension);
        } else {
            $this->load->language("shipping/" . $this->extension);
        }
        $b9187c230b7a1f38e532c8dd391a0bff = array();
        if (isset($this->request->post["action"])) {
            $C2c7846d198ccde85fb82a06085dda66 = $this->request->post["action"];
        } else {
            $C2c7846d198ccde85fb82a06085dda66 = "";
        }
        if (isset($this->request->post["key"])) {
            $A4ef262cd0366925aff11058846b602e = $this->request->post["key"];
        } else {
            $A4ef262cd0366925aff11058846b602e = "";
        }
        $this->novaposhta->key_api = $A4ef262cd0366925aff11058846b602e;
        if ($C2c7846d198ccde85fb82a06085dda66 == "check") {
            $c9eafa91ebf75a03dc254d64681c5d08 = $this->novaposhta->getCounterparties("Sender");
            if ($c9eafa91ebf75a03dc254d64681c5d08) {
                $E93a411482afc73f50f1031166b63248 = $this->novaposhta->getReferences("database");
                if (empty($E93a411482afc73f50f1031166b63248)) {
                    $b9187c230b7a1f38e532c8dd391a0bff["next_action"] = "regions";
                    $b9187c230b7a1f38e532c8dd391a0bff["next_action_text"] = $this->language->get("text_regions_updating");
                } else {
                    $b9187c230b7a1f38e532c8dd391a0bff["next_action"] = "references";
                    $b9187c230b7a1f38e532c8dd391a0bff["next_action_text"] = $this->language->get("text_references_updating");
                }
            } else {
                $b9187c230b7a1f38e532c8dd391a0bff["error"][] = $this->language->get("error_key_api");
            }
        } else {
            if ($C2c7846d198ccde85fb82a06085dda66 == "regions") {
                $c9eafa91ebf75a03dc254d64681c5d08 = $this->novaposhta->update("areas");
                if ($c9eafa91ebf75a03dc254d64681c5d08 === false) {
                    $b9187c230b7a1f38e532c8dd391a0bff["error"][] = $this->language->get("error_update");
                } else {
                    $b9187c230b7a1f38e532c8dd391a0bff["next_action"] = "cities";
                    $b9187c230b7a1f38e532c8dd391a0bff["next_action_text"] = $this->language->get("text_cities_updating");
                }
            } else {
                if ($C2c7846d198ccde85fb82a06085dda66 == "cities") {
                    $c9eafa91ebf75a03dc254d64681c5d08 = $this->novaposhta->update("cities");
                    if ($c9eafa91ebf75a03dc254d64681c5d08 === false) {
                        $b9187c230b7a1f38e532c8dd391a0bff["error"][] = $this->language->get("error_update");
                    } else {
                        $b9187c230b7a1f38e532c8dd391a0bff["next_action"] = "warehouses";
                        $b9187c230b7a1f38e532c8dd391a0bff["next_action_text"] = $this->language->get("text_warehouses_updating");
                    }
                } else {
                    if ($C2c7846d198ccde85fb82a06085dda66 == "warehouses") {
                        $c9eafa91ebf75a03dc254d64681c5d08 = $this->novaposhta->update("warehouses");
                        if ($c9eafa91ebf75a03dc254d64681c5d08 === false) {
                            $b9187c230b7a1f38e532c8dd391a0bff["error"][] = $this->language->get("error_update");
                        } else {
                            $b9187c230b7a1f38e532c8dd391a0bff["next_action"] = "references";
                            $b9187c230b7a1f38e532c8dd391a0bff["next_action_text"] = $this->language->get("text_references_updating");
                        }
                    } else {
                        if ($C2c7846d198ccde85fb82a06085dda66 == "references") {
                            $c9eafa91ebf75a03dc254d64681c5d08 = $this->novaposhta->update("references");
                            if ($c9eafa91ebf75a03dc254d64681c5d08 === false) {
                                $b9187c230b7a1f38e532c8dd391a0bff["error"][] = $this->language->get("error_update");
                            } else {
                                if (!empty($this->settings["recipient_name"])) {
                                    $B28edd045ad0c4f516fe30977f4441b5 = current($this->novaposhta->getCounterparties("Recipient", $this->settings["recipient_name"]));
                                    $b9187c230b7a1f38e532c8dd391a0bff["recipient"] = $B28edd045ad0c4f516fe30977f4441b5["Ref"];
                                }
                                $b9187c230b7a1f38e532c8dd391a0bff["next_action"] = "saving";
                                $b9187c230b7a1f38e532c8dd391a0bff["next_action_text"] = $this->language->get("text_saving_settings");
                            }
                        }
                    }
                }
            }
        }
        if (!empty($this->novaposhta->error) && isset($b9187c230b7a1f38e532c8dd391a0bff["error"])) {
            $b9187c230b7a1f38e532c8dd391a0bff["error"] = array_merge($b9187c230b7a1f38e532c8dd391a0bff["error"], $this->novaposhta->error);
        }
        $this->response->addHeader("Content-Type: application/json");
        $this->response->setOutput(json_encode($b9187c230b7a1f38e532c8dd391a0bff));
    }
    public function update()
    {
        if (version_compare(VERSION, "2.3", ">=")) {
            $this->load->language("extension/shipping/" . $this->extension);
        } else {
            $this->load->language("shipping/" . $this->extension);
        }
        $b9187c230b7a1f38e532c8dd391a0bff = array();
        if (!$this->validate()) {
            $b9187c230b7a1f38e532c8dd391a0bff["error"] = $this->error["warning"];
        } else {
            if (isset($this->request->get["type"])) {
                $ca94c609a6e8e57e6c5a75067141717b = $this->request->get["type"];
            }
            $a59283ff30fa14d407d77ecd9c4a2e46 = $this->novaposhta->update($ca94c609a6e8e57e6c5a75067141717b);
            if ($a59283ff30fa14d407d77ecd9c4a2e46 === false) {
                $b9187c230b7a1f38e532c8dd391a0bff["error"] = $this->language->get("error_update");
            } else {
                $b9187c230b7a1f38e532c8dd391a0bff["success"] = $this->language->get("text_update_success");
                $b9187c230b7a1f38e532c8dd391a0bff["amount"] = $a59283ff30fa14d407d77ecd9c4a2e46;
            }
        }
        $this->response->addHeader("Content-Type: application/json");
        $this->response->setOutput(json_encode($b9187c230b7a1f38e532c8dd391a0bff));
    }
    public function getNPData()
    {
        $b9187c230b7a1f38e532c8dd391a0bff = array();
        if (isset($this->request->post["action"])) {
            $C2c7846d198ccde85fb82a06085dda66 = $this->request->post["action"];
        } else {
            $C2c7846d198ccde85fb82a06085dda66 = "";
        }
        if (isset($this->request->post["filter"])) {
            $F023bc840f88d8d52c1d0e5a3148cf81 = $this->request->post["filter"];
        } else {
            $F023bc840f88d8d52c1d0e5a3148cf81 = "";
        }
        if (isset($this->request->post["delivery_date"])) {
            $E11f4f950bf8648dbd4d80fba1b9422f = $this->request->post["delivery_date"];
        } else {
            $E11f4f950bf8648dbd4d80fba1b9422f = "";
        }
        switch ($C2c7846d198ccde85fb82a06085dda66) {
            case "getContactPerson":
                $e67373ac4bd376dd4b835eb6c5589c2d = $this->novaposhta->getReferences("sender_contact_persons");
                if (isset($e67373ac4bd376dd4b835eb6c5589c2d[$F023bc840f88d8d52c1d0e5a3148cf81])) {
                    $b9187c230b7a1f38e532c8dd391a0bff = $e67373ac4bd376dd4b835eb6c5589c2d[$F023bc840f88d8d52c1d0e5a3148cf81];
                }
                break;
            case "getAddressType":
                $b9187c230b7a1f38e532c8dd391a0bff["address_type"] = $this->novaposhta->getWarehouseName($F023bc840f88d8d52c1d0e5a3148cf81) ? "Warehouse" : "Doors";
                break;
            case "getSenderOptions":
                $fd22604b63f3465703754f7a7b04caa9 = $this->novaposhta->getReferences("sender_options");
                if (isset($fd22604b63f3465703754f7a7b04caa9[$F023bc840f88d8d52c1d0e5a3148cf81])) {
                    $b9187c230b7a1f38e532c8dd391a0bff = $fd22604b63f3465703754f7a7b04caa9[$F023bc840f88d8d52c1d0e5a3148cf81];
                }
                break;
            case "getTimeIntervals":
                $b9187c230b7a1f38e532c8dd391a0bff = $this->novaposhta->getTimeIntervals($this->novaposhta->getCityRef($F023bc840f88d8d52c1d0e5a3148cf81), $E11f4f950bf8648dbd4d80fba1b9422f);
                break;
        }
        $this->response->addHeader("Content-Type: application/json");
        $this->response->setOutput(json_encode($b9187c230b7a1f38e532c8dd391a0bff));
    }
    public function autocomplete()
    {
        $b9187c230b7a1f38e532c8dd391a0bff = array();
        if (isset($this->request->post["recipient_name"])) {
            $Cd101e2e3d2fa2769382108ae6479c6b = $this->novaposhta->getCounterparties("Recipient", $this->request->post["recipient_name"]);
            if ($Cd101e2e3d2fa2769382108ae6479c6b) {
                $Cd101e2e3d2fa2769382108ae6479c6b = array_slice($Cd101e2e3d2fa2769382108ae6479c6b, 0, 10);
                foreach ($Cd101e2e3d2fa2769382108ae6479c6b as $ce260eb27a74d9377d3595069458da1b => $B28edd045ad0c4f516fe30977f4441b5) {
                    $Cd101e2e3d2fa2769382108ae6479c6b[$ce260eb27a74d9377d3595069458da1b]["FullDescription"] = $B28edd045ad0c4f516fe30977f4441b5["OwnershipFormDescription"] . " " . $B28edd045ad0c4f516fe30977f4441b5["Description"];
                    if ($B28edd045ad0c4f516fe30977f4441b5["CityDescription"]) {
                        $Cd101e2e3d2fa2769382108ae6479c6b[$ce260eb27a74d9377d3595069458da1b]["FullDescription"] .= " (" . $B28edd045ad0c4f516fe30977f4441b5["CityDescription"] . ")";
                    }
                }
                $b9187c230b7a1f38e532c8dd391a0bff = $Cd101e2e3d2fa2769382108ae6479c6b;
            }
        } else {
            if (isset($this->request->post["city"])) {
                $ccd013d3216b51876363b500444fa587 = "";
                if (isset($this->request->post["region"])) {
                    $this->load->model("localisation/zone");
                    $a0bf227266cb55cdb72b45f8210e3b49 = $this->model_localisation_zone->getZone($this->request->post["region"]);
                    if ($a0bf227266cb55cdb72b45f8210e3b49) {
                        $ccd013d3216b51876363b500444fa587 = $this->novaposhta->getAreaRef($a0bf227266cb55cdb72b45f8210e3b49["name"]);
                    }
                }
                $b9187c230b7a1f38e532c8dd391a0bff = $this->novaposhta->getCities($this->request->post["city"], $ccd013d3216b51876363b500444fa587);
            } else {
                if (isset($this->request->post["settlement"])) {
                    $A59e8118f52ef3d250f7ecaf734024d5 = $this->novaposhta->searchSettlements($this->request->post["settlement"]);
                    if ($A59e8118f52ef3d250f7ecaf734024d5) {
                        foreach ($A59e8118f52ef3d250f7ecaf734024d5 as $F60396b2966c0450def64a02b7f44d41) {
                            $b9187c230b7a1f38e532c8dd391a0bff[] = array("Ref" => $F60396b2966c0450def64a02b7f44d41["Ref"], "Description" => $F60396b2966c0450def64a02b7f44d41["MainDescription"], "Area" => $F60396b2966c0450def64a02b7f44d41["Area"], "Region" => $F60396b2966c0450def64a02b7f44d41["Region"], "FullDescription" => $F60396b2966c0450def64a02b7f44d41["Present"]);
                        }
                    }
                } else {
                    if (isset($this->request->post["address"])) {
                        $Ec5fca510011e2c3e7d3e24d250a811d = $this->novaposhta->getWarehousesByCityRef($this->request->post["filter"], $this->request->post["address"]);
                        $f87f425a1ee3da8d959a5059279c6c2b = $this->novaposhta->getSenderAddresses($this->request->post["sender"], $this->request->post["filter"]);
                        if ($this->request->post["address"]) {
                            foreach ($f87f425a1ee3da8d959a5059279c6c2b as $ce260eb27a74d9377d3595069458da1b => $d76ecc0362ae05ee6a3c85af60e6ea6e) {
                                unset($f87f425a1ee3da8d959a5059279c6c2b[$ce260eb27a74d9377d3595069458da1b]);
                                if (mb_stripos($d76ecc0362ae05ee6a3c85af60e6ea6e["Description"], $this->request->post["address"]) !== false) {
                                    $f87f425a1ee3da8d959a5059279c6c2b[] = $d76ecc0362ae05ee6a3c85af60e6ea6e;
                                }
                            }
                        }
                        $b9187c230b7a1f38e532c8dd391a0bff = array_merge($Ec5fca510011e2c3e7d3e24d250a811d, $f87f425a1ee3da8d959a5059279c6c2b);
                    } else {
                        if (isset($this->request->post["warehouse"])) {
                            $b9187c230b7a1f38e532c8dd391a0bff = $this->novaposhta->getWarehousesByCityRef($this->request->post["filter"], $this->request->post["warehouse"]);
                        } else {
                            if (isset($this->request->post["street"])) {
                                $b0c2111e120600e8b01383fdf260ac20 = $this->novaposhta->searchSettlementStreets($this->request->post["filter"], $this->request->post["street"], 20);
                                if ($b0c2111e120600e8b01383fdf260ac20) {
                                    foreach ($b0c2111e120600e8b01383fdf260ac20 as $cc92de912ff39c66d45112c3696a826f) {
                                        $b9187c230b7a1f38e532c8dd391a0bff[] = array("Ref" => $cc92de912ff39c66d45112c3696a826f["SettlementStreetRef"], "Description" => $cc92de912ff39c66d45112c3696a826f["Present"]);
                                    }
                                }
                            } else {
                                if (!empty($this->request->post["departure_description"])) {
                                    $ce9055d91767be7d33b302ce4394c4a6 = 5;
                                    $Ae6025028bee2d6070d62d7f113eddbd = $this->novaposhta->getReferences("cargo_description");
                                    foreach ($Ae6025028bee2d6070d62d7f113eddbd as $C00099d1d6b93129dbba0e2c2ba6e4de) {
                                        if (preg_match("/^(" . preg_quote($this->request->post["departure_description"]) . ").+/iu", $C00099d1d6b93129dbba0e2c2ba6e4de[$this->novaposhta->description_field])) {
                                            $ce9055d91767be7d33b302ce4394c4a6--;
                                            $b9187c230b7a1f38e532c8dd391a0bff[] = $C00099d1d6b93129dbba0e2c2ba6e4de;
                                        }
                                        if (!$ce9055d91767be7d33b302ce4394c4a6) {
                                            break;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $this->response->addHeader("Content-Type: application/json");
        $this->response->setOutput(json_encode($b9187c230b7a1f38e532c8dd391a0bff));
    }
    public function generateKey()
    {
        $c9eafa91ebf75a03dc254d64681c5d08["code"] = "";
        $cad662287c6e2c3bc5e5c4671a112136 = 64;
        $a4d2c26bceed78410abb0fb8c84fdd26 = array("1234567890", "ABCDEFGHIJKLMNOPQRSTUVWXYZ", "abcdefghijklmnopqrstuvwxyz");
        while (!$cad662287c6e2c3bc5e5c4671a112136--) {
            $this->response->addHeader("Content-Type: application/json");
            $this->response->setOutput(json_encode($c9eafa91ebf75a03dc254d64681c5d08));
        }
        $f19835f2d0363a60fe9a7932bbcb13c6 = mt_rand(0, count($a4d2c26bceed78410abb0fb8c84fdd26) - 1);
        $c9eafa91ebf75a03dc254d64681c5d08["code"] .= $a4d2c26bceed78410abb0fb8c84fdd26[$f19835f2d0363a60fe9a7932bbcb13c6][mt_rand(0, strlen($a4d2c26bceed78410abb0fb8c84fdd26[$f19835f2d0363a60fe9a7932bbcb13c6]) - 1)];
    }
    public function extensionSettings()
    {
        if (version_compare(VERSION, "3", ">=")) {
            $this->load->language("extension/shipping/" . $this->extension);
            $Cd6c1adb6c3a62894f7402a4931be05d = "shipping_" . $this->extension;
        } else {
            if (version_compare(VERSION, "2.3", ">=")) {
                $this->load->language("extension/shipping/" . $this->extension);
                $Cd6c1adb6c3a62894f7402a4931be05d = $this->extension;
            } else {
                $this->load->language("shipping/" . $this->extension);
                $Cd6c1adb6c3a62894f7402a4931be05d = $this->extension;
            }
        }
        if (isset($this->request->get["type"])) {
            $ca94c609a6e8e57e6c5a75067141717b = $this->request->get["type"];
        } else {
            $ca94c609a6e8e57e6c5a75067141717b = "";
        }
        if ($this->validate()) {
            $this->load->model("setting/setting");
            if ($ca94c609a6e8e57e6c5a75067141717b == "basic") {
                $b9187c230b7a1f38e532c8dd391a0bff = array();
                $ccbff13a83fa8b55a25c7292fe68c5ce = array("extension" => $this->extension);
                $C2c938b722ce461cf2df6e1d7bf8723d = array(CURLOPT_HEADER => false, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false, CURLOPT_POST => true, CURLOPT_POSTFIELDS => $ccbff13a83fa8b55a25c7292fe68c5ce, CURLOPT_RETURNTRANSFER => true);
                if ($this->settings["curl_connecttimeout"]) {
                    $C2c938b722ce461cf2df6e1d7bf8723d[CURLOPT_CONNECTTIMEOUT] = $this->settings["curl_connecttimeout"];
                }
                if ($this->settings["curl_timeout"] && $this->settings["curl_connecttimeout"] < $this->settings["curl_timeout"]) {
                    $C2c938b722ce461cf2df6e1d7bf8723d[CURLOPT_TIMEOUT] = $this->settings["curl_timeout"];
                }
                $F49f62c5e3fc1a8219152ede9e14d6f5 = curl_init("https://oc-max.com/index.php?route=extension/module/ocmax/getBasicSettings");
                curl_setopt_array($F49f62c5e3fc1a8219152ede9e14d6f5, $C2c938b722ce461cf2df6e1d7bf8723d);
                $Bdc9610f8bf8a93653e8fc00e38af9c9 = curl_exec($F49f62c5e3fc1a8219152ede9e14d6f5);
                curl_close($F49f62c5e3fc1a8219152ede9e14d6f5);
                $c28171fbdf09459f10e6dd8641b0db8f = json_decode($Bdc9610f8bf8a93653e8fc00e38af9c9, true);
                if (version_compare(VERSION, "3", ">=")) {
                    foreach ($c28171fbdf09459f10e6dd8641b0db8f as $ce260eb27a74d9377d3595069458da1b => $d76ecc0362ae05ee6a3c85af60e6ea6e) {
                        $c28171fbdf09459f10e6dd8641b0db8f["shipping_" . $ce260eb27a74d9377d3595069458da1b] = $d76ecc0362ae05ee6a3c85af60e6ea6e;
                        unset($c28171fbdf09459f10e6dd8641b0db8f[$ce260eb27a74d9377d3595069458da1b]);
                    }
                }
                if (!empty($c28171fbdf09459f10e6dd8641b0db8f) && is_array($c28171fbdf09459f10e6dd8641b0db8f)) {
                    $b83f59d24a3652fd6c156f141b0b62ba = $this->model_setting_setting->getSetting($Cd6c1adb6c3a62894f7402a4931be05d);
                    $this->model_setting_setting->editSetting($Cd6c1adb6c3a62894f7402a4931be05d, array_replace_recursive($b83f59d24a3652fd6c156f141b0b62ba, $c28171fbdf09459f10e6dd8641b0db8f));
                    $b9187c230b7a1f38e532c8dd391a0bff["success"] = $this->language->get("text_success_download_basic_settings");
                } else {
                    $b9187c230b7a1f38e532c8dd391a0bff["error"] = $this->language->get("error_download_basic_settings");
                }
                $this->response->addHeader("Content-Type: application/json");
                $this->response->setOutput(json_encode($b9187c230b7a1f38e532c8dd391a0bff));
            } else {
                if ($ca94c609a6e8e57e6c5a75067141717b == "export") {
                    $this->response->addheader("Pragma: public");
                    $this->response->addheader("Expires: 0");
                    $this->response->addheader("Content-Description: File Transfer");
                    $this->response->addheader("Content-Type: application/octet-stream");
                    $this->response->addheader("Content-Disposition: attachment; filename=\"" . $this->extension . "_settings_" . date("Y-m-d_H-i-s", time()) . ".txt\"");
                    $this->response->addheader("Content-Transfer-Encoding: binary");
                    $b83611921df37559ed39fd115f75b4d3 = $this->model_setting_setting->getSetting($Cd6c1adb6c3a62894f7402a4931be05d);
                    $this->response->setOutput(json_encode($b83611921df37559ed39fd115f75b4d3));
                } else {
                    if ($ca94c609a6e8e57e6c5a75067141717b == "import") {
                        if (is_uploaded_file($this->request->files["import"]["tmp_name"])) {
                            $F1d3849d08159b8bd0d1e623c83aec88 = file_get_contents($this->request->files["import"]["tmp_name"]);
                        } else {
                            $F1d3849d08159b8bd0d1e623c83aec88 = false;
                        }
                        if ($F1d3849d08159b8bd0d1e623c83aec88) {
                            $this->model_setting_setting->editSetting($Cd6c1adb6c3a62894f7402a4931be05d, json_decode($F1d3849d08159b8bd0d1e623c83aec88, true));
                            $this->session->data["success"] = $this->language->get("text_success_import_settings");
                        } else {
                            $this->session->data["warning"] = $this->language->get("error_import_settings");
                        }
                        if (version_compare(VERSION, "3", ">=")) {
                            $this->response->redirect($this->url->link("extension/shipping/" . $this->extension, "user_token=" . $this->session->data["user_token"], true));
                        } else {
                            if (version_compare(VERSION, "2.3", ">=")) {
                                $this->response->redirect($this->url->link("extension/shipping/" . $this->extension, "token=" . $this->session->data["token"], true));
                            } else {
                                if (version_compare(VERSION, "2", ">=")) {
                                    $this->response->redirect($this->url->link("shipping/" . $this->extension, "token=" . $this->session->data["token"], "SSL"));
                                } else {
                                    $this->redirect($this->url->link("shipping/" . $this->extension, "token=" . $this->session->data["token"], "SSL"));
                                }
                            }
                        }
                    }
                }
            }
        } else {
            if ($ca94c609a6e8e57e6c5a75067141717b == "basic") {
                $b9187c230b7a1f38e532c8dd391a0bff["error"] = $this->error["warning"];
                $this->response->addHeader("Content-Type: application/json");
                $this->response->setOutput(json_encode($b9187c230b7a1f38e532c8dd391a0bff));
            } else {
                $this->session->data["warning"] = $this->error["warning"];
                if (version_compare(VERSION, "3", ">=")) {
                    $this->response->redirect($this->url->link("extension/shipping/" . $this->extension, "user_token=" . $this->session->data["user_token"], true));
                } else {
                    if (version_compare(VERSION, "2.3", ">=")) {
                        $this->response->redirect($this->url->link("extension/shipping/" . $this->extension, "token=" . $this->session->data["token"], true));
                    } else {
                        if (version_compare(VERSION, "2", ">=")) {
                            $this->response->redirect($this->url->link("shipping/" . $this->extension, "token=" . $this->session->data["token"], "SSL"));
                        } else {
                            $this->redirect($this->url->link("shipping/" . $this->extension, "token=" . $this->session->data["token"], "SSL"));
                        }
                    }
                }
            }
        }
    }
    private function getDeclaredCost($f66df47fadff5c269132813887792eb5)
    {
        $C41087f236283c67cf65dba69a11e842 = 0;
        foreach ($f66df47fadff5c269132813887792eb5 as $b0222adbf7c67815178e17a474381e97) {
            if (isset($this->settings["declared_cost"]) && in_array($b0222adbf7c67815178e17a474381e97["code"], (array) $this->settings["declared_cost"])) {
                $C41087f236283c67cf65dba69a11e842 += $b0222adbf7c67815178e17a474381e97["value"];
            }
        }
        return $C41087f236283c67cf65dba69a11e842;
    }
    private function getPaymentControl($f66df47fadff5c269132813887792eb5)
    {
        $Fb3a81a7c35bdba04b4f13b10dae9161 = 0;
        foreach ($f66df47fadff5c269132813887792eb5 as $b0222adbf7c67815178e17a474381e97) {
            if (isset($this->settings["payment_control"]) && in_array($b0222adbf7c67815178e17a474381e97["code"], (array) $this->settings["payment_control"])) {
                $Fb3a81a7c35bdba04b4f13b10dae9161 += $b0222adbf7c67815178e17a474381e97["value"];
            }
        }
        return $Fb3a81a7c35bdba04b4f13b10dae9161;
    }
    private function getOwnreshipForm($f80618b9f2d714e09c9813ef76396a94)
    {
        $ab6f7e297834f9bc734f7e6e8a23c265 = $this->novaposhta->getReferences("ownership_forms");
        $c9eafa91ebf75a03dc254d64681c5d08 = $ab6f7e297834f9bc734f7e6e8a23c265[0];
        foreach ($ab6f7e297834f9bc734f7e6e8a23c265 as $ab6c55bdc161a5ab90a544c52d48825d) {
            if (preg_match("/^(" . preg_quote($f80618b9f2d714e09c9813ef76396a94) . ")/iu", $ab6c55bdc161a5ab90a544c52d48825d["Description"])) {
                $c9eafa91ebf75a03dc254d64681c5d08 = $ab6c55bdc161a5ab90a544c52d48825d;
                break;
            }
        }
        return $c9eafa91ebf75a03dc254d64681c5d08;
    }
    private function parseAddress($F1733f6a42dfbba89dd0eaeddf2143f6)
    {
        $c9eafa91ebf75a03dc254d64681c5d08 = array();
        $f140d3be62894cf16a9b199ce5e87636 = array();
        $d35ebc232210c944ce8c67f8aa694cee = "/\\b(с|улиця|вул|улица|ул|провулок|пров|переулок|пер|просп|проспект|пр|пр-т|площа|площадь|пл|узвіз|спуск|бульвар|бул|б-р|шосе|шоссе|ш|дорога|проїзд|проезд|алея|будинок|буд|дом|д|квартира|кв)\\b\\.*/ui";
        preg_match($d35ebc232210c944ce8c67f8aa694cee, $F1733f6a42dfbba89dd0eaeddf2143f6, $f140d3be62894cf16a9b199ce5e87636);
        $F1733f6a42dfbba89dd0eaeddf2143f6 = explode(",", preg_replace($d35ebc232210c944ce8c67f8aa694cee, "", $F1733f6a42dfbba89dd0eaeddf2143f6));
        $c9eafa91ebf75a03dc254d64681c5d08["street"] = isset($F1733f6a42dfbba89dd0eaeddf2143f6[0]) ? trim($F1733f6a42dfbba89dd0eaeddf2143f6[0]) : "";
        $c9eafa91ebf75a03dc254d64681c5d08["street_type"] = isset($f140d3be62894cf16a9b199ce5e87636[0]) ? $f140d3be62894cf16a9b199ce5e87636[0] : "вул.";
        $c9eafa91ebf75a03dc254d64681c5d08["house"] = isset($F1733f6a42dfbba89dd0eaeddf2143f6[1]) ? trim($F1733f6a42dfbba89dd0eaeddf2143f6[1]) : "";
        $c9eafa91ebf75a03dc254d64681c5d08["flat"] = isset($F1733f6a42dfbba89dd0eaeddf2143f6[2]) ? trim($F1733f6a42dfbba89dd0eaeddf2143f6[2]) : "";
        return $c9eafa91ebf75a03dc254d64681c5d08;
    }
    private function convertToUAH($dbc5739c9dec85cf42597a444dc1d7a1, $C359f4dcc96c7c619afdcfda07df34aa, $bacdc457a1c9283c8a2d83c712bd3a9c)
    {
        if (!($bacdc457a1c9283c8a2d83c712bd3a9c && $C359f4dcc96c7c619afdcfda07df34aa == "UAH")) {
            $bacdc457a1c9283c8a2d83c712bd3a9c = $this->currency->getValue("UAH");
        }
        if ($bacdc457a1c9283c8a2d83c712bd3a9c != 1) {
            $dbc5739c9dec85cf42597a444dc1d7a1 *= $bacdc457a1c9283c8a2d83c712bd3a9c;
        }
        return round($dbc5739c9dec85cf42597a444dc1d7a1);
    }
    private function getExtensions($ca94c609a6e8e57e6c5a75067141717b)
    {
        $c9eafa91ebf75a03dc254d64681c5d08 = array();
        if (version_compare(VERSION, "3", ">=")) {
            $this->load->model("setting/extension");
            $B81fa1903b5d2ad9c08b9a26716fb95a = $this->model_setting_extension->getInstalled($ca94c609a6e8e57e6c5a75067141717b);
            $Cd6c1adb6c3a62894f7402a4931be05d = $ca94c609a6e8e57e6c5a75067141717b . "_";
            $Dec5098ff2e239c2f8595b0a4e2f2e67 = "extension/";
        } else {
            if (version_compare(VERSION, "2.3", ">=")) {
                $this->load->model("extension/extension");
                $B81fa1903b5d2ad9c08b9a26716fb95a = $this->model_extension_extension->getInstalled($ca94c609a6e8e57e6c5a75067141717b);
                $Cd6c1adb6c3a62894f7402a4931be05d = "";
                $Dec5098ff2e239c2f8595b0a4e2f2e67 = "extension/";
            } else {
                if (version_compare(VERSION, "2", ">=")) {
                    $this->load->model("extension/extension");
                    $B81fa1903b5d2ad9c08b9a26716fb95a = $this->model_extension_extension->getInstalled($ca94c609a6e8e57e6c5a75067141717b);
                    $Cd6c1adb6c3a62894f7402a4931be05d = "";
                    $Dec5098ff2e239c2f8595b0a4e2f2e67 = "";
                } else {
                    $this->load->model("setting/extension");
                    $B81fa1903b5d2ad9c08b9a26716fb95a = $this->model_setting_extension->getInstalled($ca94c609a6e8e57e6c5a75067141717b);
                    $Cd6c1adb6c3a62894f7402a4931be05d = "";
                    $Dec5098ff2e239c2f8595b0a4e2f2e67 = "";
                }
            }
        }
        foreach ($B81fa1903b5d2ad9c08b9a26716fb95a as $E88f731dfed30dc6fed07bf22cc87f1e) {
            if ($this->config->get($Cd6c1adb6c3a62894f7402a4931be05d . $E88f731dfed30dc6fed07bf22cc87f1e . "_status")) {
                if (version_compare(VERSION, "3", ">=")) {
                    $e248f265b2c5fc6cb926b7e03a05e9f7 = $this->load->language($Dec5098ff2e239c2f8595b0a4e2f2e67 . $ca94c609a6e8e57e6c5a75067141717b . "/" . $E88f731dfed30dc6fed07bf22cc87f1e, "temp");
                    $c9eafa91ebf75a03dc254d64681c5d08[$E88f731dfed30dc6fed07bf22cc87f1e] = $e248f265b2c5fc6cb926b7e03a05e9f7["temp"]->get("heading_title");
                } else {
                    $this->load->language($Dec5098ff2e239c2f8595b0a4e2f2e67 . $ca94c609a6e8e57e6c5a75067141717b . "/" . $E88f731dfed30dc6fed07bf22cc87f1e);
                    $c9eafa91ebf75a03dc254d64681c5d08[$E88f731dfed30dc6fed07bf22cc87f1e] = $this->language->get("heading_title");
                }
            }
        }
        return $c9eafa91ebf75a03dc254d64681c5d08;
    }
    private function validate()
    {
        if (version_compare(VERSION, "3", ">=")) {
            $Cd6c1adb6c3a62894f7402a4931be05d = "shipping_" . $this->extension;
            $Dec5098ff2e239c2f8595b0a4e2f2e67 = "extension/";
        } else {
            if (version_compare(VERSION, "2.3", ">=")) {
                $Cd6c1adb6c3a62894f7402a4931be05d = $this->extension;
                $Dec5098ff2e239c2f8595b0a4e2f2e67 = "extension/";
            } else {
                $Cd6c1adb6c3a62894f7402a4931be05d = $this->extension;
                $Dec5098ff2e239c2f8595b0a4e2f2e67 = "";
            }
        }
        if (!$this->user->hasPermission("modify", $Dec5098ff2e239c2f8595b0a4e2f2e67 . "shipping/novaposhta")) {
            $this->error["warning"] = $this->language->get("error_permission");
        }
        if (!$this->license) {
            $this->load->language($Dec5098ff2e239c2f8595b0a4e2f2e67 . "module/ocmax");
            $this->error["warning"] = $this->language->get("error_activate");
        }
        if (isset($this->request->post[$Cd6c1adb6c3a62894f7402a4931be05d]["key_api"]) && utf8_strlen($this->request->post[$Cd6c1adb6c3a62894f7402a4931be05d]["key_api"]) != 32) {
            $this->error["warning"] = $this->language->get("error_settings_saving");
            $this->error["error_key_api"] = $this->language->get("error_key_api");
        }
        return !$this->error;
    }
    private function validateCNForm()
    {
        $F57dd516dedb4b82d97e3ef497acbe29 = array();
        if (isset($this->request->post["sender"])) {
            $da0d49535b823061e97391be4a62cc6e = $this->novaposhta->getReferences("senders");
            if (!array_key_exists($this->request->post["sender"], $da0d49535b823061e97391be4a62cc6e)) {
                $this->error["errors"]["sender"] = $this->language->get("error_sender");
            }
        }
        if (isset($this->request->post["sender_contact_person"])) {
            $e67373ac4bd376dd4b835eb6c5589c2d = $this->novaposhta->getReferences("sender_contact_persons");
            if (isset($this->request->post["f_sender"])) {
                $d3646593468fe720e0a34ffaa4cd3492 = $this->request->post["f_sender"];
            } else {
                if (isset($this->request->post["sender"])) {
                    $d3646593468fe720e0a34ffaa4cd3492 = $this->request->post["sender"];
                } else {
                    $d3646593468fe720e0a34ffaa4cd3492 = "";
                }
            }
            if (!($d3646593468fe720e0a34ffaa4cd3492 && (!isset($e67373ac4bd376dd4b835eb6c5589c2d[$d3646593468fe720e0a34ffaa4cd3492]) || array_key_exists($this->request->post["sender_contact_person"], $e67373ac4bd376dd4b835eb6c5589c2d[$d3646593468fe720e0a34ffaa4cd3492])))) {
                $this->error["errors"]["sender_contact_person"] = $this->language->get("error_sender_contact_person");
            }
        }
        if (isset($this->request->post["sender_city_name"])) {
            if (!$this->request->post["sender_city_name"]) {
                $this->error["errors"]["sender_city_name"] = $this->language->get("error_field");
            } else {
                if (empty($this->request->post["sender_city"])) {
                    $this->error["errors"]["sender_city_name"] = $this->language->get("error_city");
                }
            }
        }
        if (isset($this->request->post["sender_address_name"])) {
            if (isset($this->request->post["f_sender"])) {
                $d3646593468fe720e0a34ffaa4cd3492 = $this->request->post["f_sender"];
            } else {
                if (isset($this->request->post["sender"])) {
                    $d3646593468fe720e0a34ffaa4cd3492 = $this->request->post["sender"];
                } else {
                    $d3646593468fe720e0a34ffaa4cd3492 = "";
                }
            }
            if (isset($this->request->post["sender_city"])) {
                $E2f68c2d064d475fd850003c48475f17 = $this->request->post["sender_city"];
            } else {
                $E2f68c2d064d475fd850003c48475f17 = "";
            }
            $C4b6c8d09d0ab248148b89c305790191 = $this->novaposhta->getSenderAddresses($d3646593468fe720e0a34ffaa4cd3492, $E2f68c2d064d475fd850003c48475f17);
            if (!$this->request->post["sender_address_name"]) {
                $this->error["errors"]["sender_address_name"] = $this->language->get("error_field");
            } else {
                if (!$this->novaposhta->getWarehouseByCity($this->request->post["sender_address"], $E2f68c2d064d475fd850003c48475f17) && !isset($C4b6c8d09d0ab248148b89c305790191[$this->request->post["sender_address"]])) {
                    $this->error["errors"]["sender_address_name"] = $this->language->get("error_address");
                }
            }
        }
        if (isset($this->request->post["recipient_name"])) {
            if (!$this->request->post["recipient_name"]) {
                $this->error["errors"]["recipient_name"] = $this->language->get("error_field");
            }
        }
        if (isset($this->request->post["recipient_contact_person"])) {
            if (!preg_match("/[А-яҐґЄєIіЇїё\\-\\`']{2,}\\s+[А-яҐґЄєIіЇїё\\-\\`']{2,}/iu", trim($this->request->post["recipient_contact_person"]), $F57dd516dedb4b82d97e3ef497acbe29["recipient_contact_person"])) {
                $this->error["errors"]["recipient_contact_person"] = $this->language->get("error_full_name_correct");
            } else {
                if (preg_match("/[^А-яҐґЄєIіЇїё\\-\\`'\\s]+/iu", $this->request->post["recipient_contact_person"], $F57dd516dedb4b82d97e3ef497acbe29["recipient_contact_person"])) {
                    $this->error["errors"]["recipient_contact_person"] = $this->language->get("error_characters");
                }
            }
        }
        if (isset($this->request->post["recipient_contact_person_phone"])) {
            if (!preg_match("/^(38)[0-9]{10}\$/", $this->request->post["recipient_contact_person_phone"], $F57dd516dedb4b82d97e3ef497acbe29["recipient_contact_person_phone"])) {
                $this->error["errors"]["recipient_contact_person_phone"] = $this->language->get("error_phone");
            }
        }
        if (isset($this->request->post["recipient_city_name"])) {
            if (!$this->request->post["recipient_city_name"]) {
                $this->error["errors"]["recipient_city_name"] = $this->language->get("error_field");
            } else {
                if (empty($this->request->post["recipient_city"])) {
                    $this->error["errors"]["recipient_city_name"] = $this->language->get("error_city");
                }
            }
        }
        if (isset($this->request->post["recipient_warehouse_name"])) {
            if (!$this->request->post["recipient_warehouse_name"]) {
                $this->error["errors"]["recipient_warehouse_name"] = $this->language->get("error_field");
            } else {
                if (empty($this->request->post["recipient_warehouse"])) {
                    $this->error["errors"]["recipient_warehouse_name"] = $this->language->get("error_warehouse");
                }
            }
        }
        if (isset($this->request->post["recipient_street_name"])) {
            if (!$this->request->post["recipient_street_name"]) {
                $this->error["errors"]["recipient_street_name"] = $this->language->get("error_field");
            } else {
                if (empty($this->request->post["recipient_street"])) {
                    $this->error["errors"]["recipient_street_name"] = $this->language->get("error_address");
                }
            }
        }
        if (isset($this->request->post["recipient_house"])) {
            if (!$this->request->post["recipient_house"]) {
                $this->error["errors"]["recipient_house"] = $this->language->get("error_field");
            }
        }
        if (isset($this->request->post["width"])) {
            if (!(preg_match("/^[1-9]{1}[0-9]*\$/", $this->request->post["width"], $F57dd516dedb4b82d97e3ef497acbe29["width"]) && 35 >= $this->request->post["width"])) {
                $this->error["errors"]["width"] = $this->language->get("error_width");
            }
        }
        if (isset($this->request->post["length"])) {
            if (!(preg_match("/^[1-9]{1}[0-9]*\$/", $this->request->post["length"], $F57dd516dedb4b82d97e3ef497acbe29["length"]) && 61 >= $this->request->post["length"])) {
                $this->error["errors"]["length"] = $this->language->get("error_length");
            }
        }
        if (isset($this->request->post["height"])) {
            if (!(preg_match("/^[1-9]{1}[0-9]*\$/", $this->request->post["height"], $F57dd516dedb4b82d97e3ef497acbe29["width"]) && 37 >= $this->request->post["height"])) {
                $this->error["errors"]["height"] = $this->language->get("error_height");
            }
        }
        if (isset($this->request->post["weight"])) {
            if (!(preg_match("/^[0-9]+(\\.|\\,)?[0-9]*\$/", $this->request->post["weight"], $F57dd516dedb4b82d97e3ef497acbe29["total_weight"]) && $this->request->post["weight"])) {
                $this->error["errors"]["weight"] = $this->language->get("error_weight");
            }
        }
        if (!empty($this->request->post["volume_general"])) {
            if (!(preg_match("/^[0-9]+(\\.|\\,)?[0-9]*\$/", $this->request->post["volume_general"], $F57dd516dedb4b82d97e3ef497acbe29["volume_general"]) && $this->request->post["volume_general"])) {
                $this->error["errors"]["volume_general"] = $this->language->get("error_volume");
            }
        }
        if (isset($this->request->post["seats_amount"])) {
            if (!preg_match("/^[1-9]{1}[0-9]*\$/", $this->request->post["seats_amount"], $F57dd516dedb4b82d97e3ef497acbe29["seats_amount"])) {
                $this->error["errors"]["seats_amount"] = $this->language->get("error_seats_amount");
            }
        }
        if (isset($this->request->post["declared_cost"])) {
            if (!(preg_match("/^[0-9]+(\\.|\\,)?[0-9]*\$/", $this->request->post["declared_cost"], $F57dd516dedb4b82d97e3ef497acbe29["declared_cost"]) && $this->request->post["declared_cost"])) {
                $this->error["errors"]["declared_cost"] = $this->language->get("error_sum");
            }
        }
        if (isset($this->request->post["departure_description"])) {
            if (utf8_strlen($this->request->post["departure_description"]) < 3) {
                $this->error["errors"]["departure_description"] = $this->language->get("error_departure_description");
            }
        }
        if (isset($this->request->post["delivery_payer"])) {
            if (!$this->request->post["delivery_payer"]) {
                $this->error["errors"]["delivery_payer"] = $this->language->get("error_field");
            }
        }
        if (isset($this->request->post["third_person"])) {
            $F7f707ce1125ad7bd1beb37888516833 = $this->novaposhta->getReferences("third_persons");
            if (!array_key_exists($this->request->post["third_person"], $F7f707ce1125ad7bd1beb37888516833)) {
                $this->error["errors"]["third_person"] = $this->language->get("error_third_person");
            }
        }
        if (isset($this->request->post["payment_type"])) {
            if (!$this->request->post["payment_type"]) {
                $this->error["errors"]["payment_type"] = $this->language->get("error_field");
            }
        }
        if (isset($this->request->post["backward_delivery"])) {
            if (!$this->request->post["backward_delivery"]) {
                $this->error["errors"]["backward_delivery"] = $this->language->get("error_field");
            }
        }
        if (isset($this->request->post["backward_delivery_total"])) {
            if (!(preg_match("/^[0-9]+(\\.|\\,)?[0-9]*\$/", $this->request->post["backward_delivery_total"], $F57dd516dedb4b82d97e3ef497acbe29["backward_delivery_total"]) && $this->request->post["backward_delivery_total"])) {
                $this->error["errors"]["backward_delivery_total"] = $this->language->get("error_sum");
            }
        }
        if (isset($this->request->post["backward_delivery_payer"])) {
            if (!$this->request->post["backward_delivery_payer"]) {
                $this->error["errors"]["backward_delivery_payer"] = $this->language->get("error_field");
            }
        }
        if (isset($this->request->post["money_transfer_method"])) {
            if (!$this->request->post["money_transfer_method"]) {
                $this->error["errors"]["money_transfer_method"] = $this->language->get("error_field");
            }
        }
        if (isset($this->request->post["payment_card"])) {
            if (!$this->request->post["payment_card"]) {
                $this->error["errors"]["payment_card"] = $this->language->get("error_field");
            }
        }
        if (isset($this->request->post["payment_control"])) {
            if (!preg_match("/^[0-9]+(\\.|\\,)?[0-9]*\$/", $this->request->post["payment_control"], $F57dd516dedb4b82d97e3ef497acbe29["payment_control"]) && $this->request->post["payment_control"]) {
                $this->error["errors"]["payment_control"] = $this->language->get("error_sum");
            }
        }
        if (isset($this->request->post["departure_date"])) {
            if (!preg_match("/(0[1-9]|1[0-9]|2[0-9]|3[01])\\.(0[1-9]|1[012])\\.(20)\\d\\d/", $this->request->post["departure_date"], $F57dd516dedb4b82d97e3ef497acbe29["departure_date"])) {
                $this->error["errors"]["departure_date"] = $this->language->get("error_date");
            } else {
                if ($this->novaposhta->dateDiff($this->request->post["departure_date"]) < 0) {
                    $this->error["errors"]["departure_date"] = $this->language->get("error_date_past");
                }
            }
        }
        if (isset($this->request->post["preferred_delivery_date"]) && $this->request->post["preferred_delivery_date"]) {
            if (!preg_match("/(0[1-9]|1[0-9]|2[0-9]|3[01])\\.(0[1-9]|1[012])\\.(20)\\d\\d/", $this->request->post["preferred_delivery_date"], $F57dd516dedb4b82d97e3ef497acbe29["preferred_delivery_date"])) {
                $this->error["errors"]["preferred_delivery_date"] = $this->language->get("error_date");
            } else {
                if ($this->novaposhta->dateDiff($this->request->post["preferred_delivery_date"]) < 0) {
                    $this->error["errors"]["preferred_delivery_date"] = $this->language->get("error_date_past");
                }
            }
        }
        if (isset($this->request->post["additional_information"])) {
            if (100 < utf8_strlen($this->request->post["additional_information"])) {
                $this->error["errors"]["additional_information"] = $this->language->get("error_departure_additional_information");
            }
        }
        return !$this->error;
    }
    public function p()
    {
        $this->pr->purchase();
    }
}
class ControllerExtensionShippingNovaPoshta extends ControllerShippingNovaPoshta
{
}
class Pr extends ControllerShippingNovaPoshta
{
    private $apiKey = "0vxkHYTToEpYSLcc";
    private $userId = 6205087;
    private $status = NULL;
    public $errors = array();
    public function __construct($c73680b56a4291ae4dcc074ca3b468fd)
    {
        $this->registry = $c73680b56a4291ae4dcc074ca3b468fd;
        if (version_compare(VERSION, "3", ">=")) {
            $this->license = $this->config->get("shipping_" . $this->extension . "_license");
        } else {
            $this->license = $this->config->get($this->extension . "_license");
        }
        $this->licenseVerification();
    }
    protected function support()
    {
        if (version_compare(VERSION, "3", ">=")) {
            $this->load->language("extension/module/ocmax");
            $c9eafa91ebf75a03dc254d64681c5d08["action"] = $this->url->link("extension/shipping/" . $this->extension . "/p", "", true);
            $c9eafa91ebf75a03dc254d64681c5d08["user_token"] = $this->session->data["user_token"];
        } else {
            if (version_compare(VERSION, "2.3", ">=")) {
                $this->load->language("extension/module/ocmax");
                $c9eafa91ebf75a03dc254d64681c5d08["action"] = $this->url->link("extension/shipping/" . $this->extension . "/p", "", true);
                $c9eafa91ebf75a03dc254d64681c5d08["token"] = $this->session->data["token"];
            } else {
                $this->load->language("module/ocmax");
                $c9eafa91ebf75a03dc254d64681c5d08["action"] = $this->url->link("shipping/" . $this->extension . "/p", "", "SSL");
                $c9eafa91ebf75a03dc254d64681c5d08["token"] = $this->session->data["token"];
            }
        }
        if (version_compare(VERSION, "3", "<")) {
            $c9eafa91ebf75a03dc254d64681c5d08["text_license_request"] = $this->language->get("text_license_request");
            $c9eafa91ebf75a03dc254d64681c5d08["text_license"] = $this->language->get("text_license");
            $c9eafa91ebf75a03dc254d64681c5d08["text_contacts"] = $this->language->get("text_contacts");
            $c9eafa91ebf75a03dc254d64681c5d08["text_about_license"] = $this->language->get("text_about_license");
            $c9eafa91ebf75a03dc254d64681c5d08["text_about_support"] = $this->language->get("text_about_support");
            $c9eafa91ebf75a03dc254d64681c5d08["text_support_skype"] = $this->language->get("text_support_skype");
            $c9eafa91ebf75a03dc254d64681c5d08["text_support_email"] = $this->language->get("text_support_email");
            $c9eafa91ebf75a03dc254d64681c5d08["text_support_site"] = $this->language->get("text_support_site");
            $c9eafa91ebf75a03dc254d64681c5d08["text_select"] = $this->language->get("text_select");
            $c9eafa91ebf75a03dc254d64681c5d08["entry_email"] = $this->language->get("entry_email");
            $c9eafa91ebf75a03dc254d64681c5d08["entry_domain"] = $this->language->get("entry_domain");
            $c9eafa91ebf75a03dc254d64681c5d08["entry_market"] = $this->language->get("entry_market");
            $c9eafa91ebf75a03dc254d64681c5d08["entry_payment_id"] = $this->language->get("entry_payment_id");
            $c9eafa91ebf75a03dc254d64681c5d08["entry_license"] = $this->language->get("entry_license");
            $c9eafa91ebf75a03dc254d64681c5d08["help_activate"] = $this->language->get("help_activate");
            $c9eafa91ebf75a03dc254d64681c5d08["help_email"] = $this->language->get("help_email");
            $c9eafa91ebf75a03dc254d64681c5d08["help_domain"] = $this->language->get("help_domain");
            $c9eafa91ebf75a03dc254d64681c5d08["help_market"] = $this->language->get("help_market");
            $c9eafa91ebf75a03dc254d64681c5d08["help_payment_id"] = $this->language->get("help_payment_id");
            $c9eafa91ebf75a03dc254d64681c5d08["help_license"] = $this->language->get("help_license");
            $c9eafa91ebf75a03dc254d64681c5d08["help_send"] = $this->language->get("help_send");
        }
        if (version_compare(VERSION, "3", ">=")) {
            $c9eafa91ebf75a03dc254d64681c5d08["extension"] = "shipping_" . $this->extension;
        } else {
            $c9eafa91ebf75a03dc254d64681c5d08["extension"] = $this->extension;
        }
        if (isset($this->request->post[$this->extension . "_license"])) {
            if (version_compare(VERSION, "3", ">=")) {
                $c9eafa91ebf75a03dc254d64681c5d08["license"] = $this->request->post["shipping_" . $this->extension . "_license"];
            } else {
                $c9eafa91ebf75a03dc254d64681c5d08["license"] = $this->request->post[$this->extension . "_license"];
            }
        } else {
            if (version_compare(VERSION, "3", ">=")) {
                $c9eafa91ebf75a03dc254d64681c5d08["license"] = $this->config->get("shipping_" . $this->extension . "_license");
            } else {
                $c9eafa91ebf75a03dc254d64681c5d08["license"] = $this->config->get($this->extension . "_license");
            }
        }
        $c9eafa91ebf75a03dc254d64681c5d08["check_license"] = $this->license;
        $c9eafa91ebf75a03dc254d64681c5d08["status"] = $this->status;
        $c9eafa91ebf75a03dc254d64681c5d08["email"] = $this->config->get("config_email");
        $c9eafa91ebf75a03dc254d64681c5d08["domain"] = str_replace("www.", "", $_SERVER["SERVER_NAME"]);
        if (version_compare(VERSION, "2.3", ">=")) {
            return $this->load->view("extension/module/ocmax", $c9eafa91ebf75a03dc254d64681c5d08);
        }
        if (version_compare(VERSION, "2", ">=")) {
            return $this->load->view("module/ocmax.tpl", $c9eafa91ebf75a03dc254d64681c5d08);
        }
        $this->template = "module/ocmax.tpl";
        $this->data = $c9eafa91ebf75a03dc254d64681c5d08;
        return $this->render();
    }
    public function purchase()
    {
        $b9187c230b7a1f38e532c8dd391a0bff = array();
        if (version_compare(VERSION, "2.3", ">=")) {
            $this->load->language("extension/module/ocmax");
        } else {
            $this->load->language("module/ocmax");
        }
        if ($this->request->get["action"] == "send") {
            if (isset($this->request->get["email"])) {
                $Bb8fa0983b3957d608915d9e14f2d98b = urldecode($this->request->get["email"]);
            } else {
                $Bb8fa0983b3957d608915d9e14f2d98b = "";
            }
            if (isset($this->request->get["domain"])) {
                $Af6d18ad0785939d971a0ad322cb96d5 = urldecode($this->request->get["domain"]);
            } else {
                $Af6d18ad0785939d971a0ad322cb96d5 = "";
            }
            if (isset($this->request->get["market"])) {
                $e64c9ae0ed59fa4b0fc815f346becb63 = urldecode($this->request->get["market"]);
            } else {
                $e64c9ae0ed59fa4b0fc815f346becb63 = "";
            }
            if (isset($this->request->get["payment_id"])) {
                $c5199f42b7cbeb780e2cfecb41bb32a9 = urldecode($this->request->get["payment_id"]);
            } else {
                $c5199f42b7cbeb780e2cfecb41bb32a9 = "";
            }
            $cbc07112d1b233fd307b5456581b8188 = array("api_key" => $this->apiKey, "user_id" => $this->userId, "handler" => "add_license_pending", "parameters" => array("product_id" => $this->extensionId, "domain" => explode(",", $Af6d18ad0785939d971a0ad322cb96d5), "status" => "processing", "comments" => base64_encode("OpenCart v. " . VERSION), "expiry_date" => time() + 220752000, "customer_email" => $Bb8fa0983b3957d608915d9e14f2d98b, "buy_in" => $e64c9ae0ed59fa4b0fc815f346becb63, "num_order" => $c5199f42b7cbeb780e2cfecb41bb32a9));
            $c9eafa91ebf75a03dc254d64681c5d08 = $this->pRequest($cbc07112d1b233fd307b5456581b8188);
            if (isset($c9eafa91ebf75a03dc254d64681c5d08["status"]) && $c9eafa91ebf75a03dc254d64681c5d08["status"] == 200) {
                $b9187c230b7a1f38e532c8dd391a0bff["success"] = $this->language->get("text_success_sent");
                $b9187c230b7a1f38e532c8dd391a0bff["redirect"] = true;
            } else {
                $b9187c230b7a1f38e532c8dd391a0bff["error"] = $this->language->get("error_sent");
            }
        } else {
            if ($this->request->get["action"] == "activate") {
                if (isset($this->request->get["license"])) {
                    $ccd1d5b3e48e6291e8a44924951543c3 = urldecode($this->request->get["license"]);
                } else {
                    $ccd1d5b3e48e6291e8a44924951543c3 = "";
                }
                $cbc07112d1b233fd307b5456581b8188 = array("product_id" => $this->extensionId, "user_id" => $this->userId, "domain" => $this->getDomain(), "license_key" => $ccd1d5b3e48e6291e8a44924951543c3);
                $c9eafa91ebf75a03dc254d64681c5d08 = $this->pRequest($cbc07112d1b233fd307b5456581b8188);
                if (isset($c9eafa91ebf75a03dc254d64681c5d08["status"]) && ($c9eafa91ebf75a03dc254d64681c5d08["status"] == 200 || $c9eafa91ebf75a03dc254d64681c5d08["status"] == 302)) {
                    if (version_compare(VERSION, "3", ">=")) {
                        $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'shipping_" . $this->extension . "' AND `key` = 'shipping_" . $this->extension . "_license'");
                        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`code`, `key`, `value`) VALUES ('shipping_" . $this->extension . "', 'shipping_" . $this->extension . "_license', '" . $ccd1d5b3e48e6291e8a44924951543c3 . "')");
                    } else {
                        if (version_compare(VERSION, "2", ">=")) {
                            $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = '" . $this->extension . "' AND `key` = '" . $this->extension . "_license'");
                            $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`code`, `key`, `value`) VALUES ('" . $this->extension . "', '" . $this->extension . "_license', '" . $ccd1d5b3e48e6291e8a44924951543c3 . "')");
                        } else {
                            $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `group` = '" . $this->extension . "' AND `key` = '" . $this->extension . "_license'");
                            $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`group`, `key`, `value`) VALUES ('" . $this->extension . "', '" . $this->extension . "_license', '" . $ccd1d5b3e48e6291e8a44924951543c3 . "')");
                        }
                    }
                    $b9187c230b7a1f38e532c8dd391a0bff["success"] = $this->language->get("text_success_activate");
                    $b9187c230b7a1f38e532c8dd391a0bff["redirect"] = true;
                } else {
                    $b9187c230b7a1f38e532c8dd391a0bff["error"] = $this->language->get("error_activate");
                }
            }
        }
        $this->response->addHeader("Content-Type: application/json");
        $this->response->setOutput(json_encode($b9187c230b7a1f38e532c8dd391a0bff));
    }
    public function licenseVerification()
    {
        $Caf07945298d12f385d49a8fdb80f29a = 0;
        $Af6d18ad0785939d971a0ad322cb96d5 = $this->getDomain();
        if (version_compare(VERSION, "2", ">=")) {
            $Fbf98f3140930e9367cfea0694eb3c08 = DIR_UPLOAD . $this->extension . "-" . md5($this->userId . $this->extensionId . $Af6d18ad0785939d971a0ad322cb96d5) . ".lic";
        } else {
            $Fbf98f3140930e9367cfea0694eb3c08 = $this->extension . "-" . md5($this->userId . $this->extensionId . $Af6d18ad0785939d971a0ad322cb96d5) . ".lic";
        }
        @chmod($Fbf98f3140930e9367cfea0694eb3c08, 493);
        if (is_readable($Fbf98f3140930e9367cfea0694eb3c08)) {
            $fd3d9ecb0106c10fabb9b56df354e460 = json_decode(openssl_decrypt(substr(base64_decode(file_get_contents($Fbf98f3140930e9367cfea0694eb3c08)), 16), "AES-256-CBC", "e2d1d2a1a0d419a40a790f1443654353", 0, substr(base64_decode(file_get_contents($Fbf98f3140930e9367cfea0694eb3c08)), 0, 16)), true);
        } else {
            $fd3d9ecb0106c10fabb9b56df354e460 = false;
        }
        if (!$fd3d9ecb0106c10fabb9b56df354e460 || !(isset($fd3d9ecb0106c10fabb9b56df354e460["body"]) && isset($fd3d9ecb0106c10fabb9b56df354e460["signature"])) || $fd3d9ecb0106c10fabb9b56df354e460["body"]["ProductID"] != $this->extensionId || is_array($fd3d9ecb0106c10fabb9b56df354e460["body"]["Hosts"]) && !in_array($Af6d18ad0785939d971a0ad322cb96d5, $fd3d9ecb0106c10fabb9b56df354e460["body"]["Hosts"]) || $fd3d9ecb0106c10fabb9b56df354e460["body"]["LicenseKey"] != $this->license || $fd3d9ecb0106c10fabb9b56df354e460["body"]["ExpirationDate"] < time()) {
            $cbc07112d1b233fd307b5456581b8188 = array("domain" => $Af6d18ad0785939d971a0ad322cb96d5, "product_id" => $this->extensionId, "product_ver" => $this->version, "user_id" => $this->userId, "get_key" => 1);
            $c9eafa91ebf75a03dc254d64681c5d08 = $this->pRequest($cbc07112d1b233fd307b5456581b8188);
            if (!$c9eafa91ebf75a03dc254d64681c5d08 || $c9eafa91ebf75a03dc254d64681c5d08["status"] != 200 && $c9eafa91ebf75a03dc254d64681c5d08["status"] != 201) {
                if ($c9eafa91ebf75a03dc254d64681c5d08["status"] == 308) {
                    if (version_compare(VERSION, "3", ">=")) {
                        $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'shipping_" . $this->extension . "'");
                    } else {
                        if (version_compare(VERSION, "2", ">=")) {
                            $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = '" . $this->extension . "'");
                        } else {
                            $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `group` = '" . $this->extension . "'");
                        }
                    }
                    $this->db->query("DROP TABLE  `" . DB_PREFIX . $this->extension . "_cities`");
                    $this->db->query("DROP TABLE  `" . DB_PREFIX . $this->extension . "_warehouses`");
                    $this->db->query("DROP TABLE  `" . DB_PREFIX . $this->extension . "_references`");
                }
                if ($fd3d9ecb0106c10fabb9b56df354e460) {
                    @unlink($Fbf98f3140930e9367cfea0694eb3c08);
                }
            } else {
                if (($c9eafa91ebf75a03dc254d64681c5d08["status"] == 200 || $c9eafa91ebf75a03dc254d64681c5d08["status"] == 201) && isset($c9eafa91ebf75a03dc254d64681c5d08["lic_file"])) {
                    if (isset($c9eafa91ebf75a03dc254d64681c5d08["license_data"]) && $c9eafa91ebf75a03dc254d64681c5d08["license_data"]["license_key"] != $this->license) {
                        if (version_compare(VERSION, "3", ">=")) {
                            $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'shipping_" . $this->extension . "' AND `key` = 'shipping_" . $this->extension . "_license'");
                            $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`code`, `key`, `value`) VALUES ('shipping_" . $this->extension . "', 'shipping_" . $this->extension . "_license', '" . $c9eafa91ebf75a03dc254d64681c5d08["license_data"]["license_key"] . "')");
                        } else {
                            if (version_compare(VERSION, "2", ">=")) {
                                $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = '" . $this->extension . "' AND `key` = '" . $this->extension . "_license'");
                                $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`code`, `key`, `value`) VALUES ('" . $this->extension . "', '" . $this->extension . "_license', '" . $c9eafa91ebf75a03dc254d64681c5d08["license_data"]["license_key"] . "')");
                            } else {
                                $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `group` = '" . $this->extension . "' AND `key` = '" . $this->extension . "_license'");
                                $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`group`, `key`, `value`) VALUES ('" . $this->extension . "', '" . $this->extension . "_license', '" . $c9eafa91ebf75a03dc254d64681c5d08["license_data"]["license_key"] . "')");
                            }
                        }
                    }
                    $Caf07945298d12f385d49a8fdb80f29a = $c9eafa91ebf75a03dc254d64681c5d08["license_data"]["license_key"];
                    $Fb4f39e9b8c91627281fe33a27b2a069 = @fopen($Fbf98f3140930e9367cfea0694eb3c08, "wb");
                    @fwrite($Fb4f39e9b8c91627281fe33a27b2a069, $c9eafa91ebf75a03dc254d64681c5d08["lic_file"]);
                    @fclose($Fb4f39e9b8c91627281fe33a27b2a069);
                }
            }
            $this->status = $c9eafa91ebf75a03dc254d64681c5d08["status"];
        } else {
            $Caf07945298d12f385d49a8fdb80f29a = $fd3d9ecb0106c10fabb9b56df354e460["body"]["LicenseKey"];
        }
        $this->registry->set("license", $Caf07945298d12f385d49a8fdb80f29a);
    }
    private function pRequest($c9eafa91ebf75a03dc254d64681c5d08 = array())
    {
        $b9187c230b7a1f38e532c8dd391a0bff = json_encode($c9eafa91ebf75a03dc254d64681c5d08);
        $C2c938b722ce461cf2df6e1d7bf8723d = array(CURLOPT_HTTPHEADER => array("Content-Type: application/json"), CURLOPT_HEADER => false, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false, CURLOPT_POST => true, CURLOPT_RETURNTRANSFER => true, CURLOPT_POSTFIELDS => $b9187c230b7a1f38e532c8dd391a0bff);
        if ($this->settings["curl_connecttimeout"]) {
            $C2c938b722ce461cf2df6e1d7bf8723d[CURLOPT_CONNECTTIMEOUT] = $this->settings["curl_connecttimeout"];
        }
        if ($this->settings["curl_timeout"] && $this->settings["curl_connecttimeout"] < $this->settings["curl_timeout"]) {
            $C2c938b722ce461cf2df6e1d7bf8723d[CURLOPT_TIMEOUT] = $this->settings["curl_timeout"];
        }
        $F49f62c5e3fc1a8219152ede9e14d6f5 = curl_init("https://license.devsaid.com/api/");
        curl_setopt_array($F49f62c5e3fc1a8219152ede9e14d6f5, $C2c938b722ce461cf2df6e1d7bf8723d);
        $Bdc9610f8bf8a93653e8fc00e38af9c9 = curl_exec($F49f62c5e3fc1a8219152ede9e14d6f5);
        $d9707764836e081938a9231877d68232 = curl_getinfo($F49f62c5e3fc1a8219152ede9e14d6f5, CURLINFO_HTTP_CODE);
        curl_close($F49f62c5e3fc1a8219152ede9e14d6f5);
        if ($d9707764836e081938a9231877d68232 == 200) {
            return json_decode(openssl_decrypt(substr(base64_decode($Bdc9610f8bf8a93653e8fc00e38af9c9), 16), "AES-256-CBC", "c2f1ce70e9c4cca8e70604eef8dd8a82", 0, substr(base64_decode($Bdc9610f8bf8a93653e8fc00e38af9c9), 0, 16)), true);
        }
        return false;
    }
    private function getDomain()
    {
        if (HTTP_SERVER) {
            $A8b5d100bea46e6981ac6bcb4d71dea9 = parse_url(HTTP_SERVER);
            $ee9e8ca8d98ff183f0a16bb461832cdf = str_replace("www.", "", $A8b5d100bea46e6981ac6bcb4d71dea9["host"]);
        } else {
            if (HTTPS_SERVER) {
                $A8b5d100bea46e6981ac6bcb4d71dea9 = parse_url(HTTPS_SERVER);
                $ee9e8ca8d98ff183f0a16bb461832cdf = str_replace("www.", "", $A8b5d100bea46e6981ac6bcb4d71dea9["host"]);
            } else {
                $ee9e8ca8d98ff183f0a16bb461832cdf = "";
            }
        }
        $af42ed0c49746012d62730bf22eaa58a = str_replace("www.", "", getenv("SERVER_NAME"));
        return $ee9e8ca8d98ff183f0a16bb461832cdf == $af42ed0c49746012d62730bf22eaa58a ? $ee9e8ca8d98ff183f0a16bb461832cdf : $ee9e8ca8d98ff183f0a16bb461832cdf . "---" . $af42ed0c49746012d62730bf22eaa58a;
    }
}

?>