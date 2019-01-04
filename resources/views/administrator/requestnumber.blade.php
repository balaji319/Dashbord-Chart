@extends('theme.default')
@section('title', 'Call-Q Reporting Service')
@section('content')
<?php
date_default_timezone_set('America/Los_Angeles');
$unixTime = time();
$var_date = date("D - M. d Y", $unixTime);  ?>
  <div class="">
    {{--
    <div class="page-title">
      <div class="title_left">
        <h3>Map Calls <small></small></h3>
      </div>
    </div> --}}
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="x_panel" style="min-height: 100vh;">
          <div class="x_title">
            <h2>Request A New Number - <small>Please fill out all fields</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div>
              <div class="alert alert-success" id="SuccessDiv" style="display:none">
                <strong>Success!</strong> Request Send Successfully !!!
              </div>
              <div class="alert alert-danger" id="ErrorDiv" style="display:none">
                <strong>Error!</strong> Somthing Went Wrong !!!
              </div>
              <div class="starrr stars"></div>
              <center><span>Lead Times (in business days) <br><br> Allow for additional lead time if custom programming is needed <br><br></center><ul style="list-style: none;    margin-left: 23%;">
                                    <li><span style=" color: black; font-weight: 800;">7 Days:</span><strong style="color: black;">        United States TFN or Local DID </strong>
                <span style="color: red;">(average 3 days)<span></span></span>
                </li>
                <li><span style=" color: black; font-weight: 800;">7 Days:</span><strong style="color: black;">        Canada TFN DID  </strong>
                  <span style="color: red;">(average 3 days)<span></span></span>
                </li>
                <li><span style=" color: black; font-weight: 800;">30 Days:</span><strong style="color: black;">       UK TFN or Local London DDI</strong>
                  <span style="color: red;">(average 7 days)<span></span></span>
                </li>
                <li><span style=" color: black; font-weight: 800;">30 Days:</span><strong style="color: black;">       Australia TFN or Local DID </strong>
                  <span style="color: red;">(average 20 days)<span></span></span>
                </li>
                <ul>
            </div>
            <br />
            <form class="form-horizontal form-label-left col-md-10 col-sm-10 col-xs-10" id="requestform">
              <div class="form-group  col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label>Your Name:</label>
                  <input type="text" required="required" class="form-control" name="name" placeholder="Enter Your Name">
                </div>
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12 ">
                <div class="form-group">
                  <label>Your Email:</label>
                  <input type="email" required="required" class="form-control" name="email" placeholder="Enter Your Name">
                </div>

              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label>Station Name:</label>
                  <input type="text" required="required" class="form-control" name="station_name" placeholder="Enter Station Name">
                </div>
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label>Is This Urgent ?</label>
                  <div class="container" style="    display: inline-flex;">
                    <div class="radio">
                      <input id="isUrgent-1" name="urgent" type="radio" checked value="Yes">
                      <label for="isUrgent-1" class="radio-label">Yes</label>
                    </div>
                    <div class="radio">
                      <input id="isUrgent-2" name="urgent" type="radio" value="No">
                      <label for="isUrgent-2" class="radio-label">No</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12 ">
                <div class="form-group">
                  <label>Country:</label>
                  <select class="form-control" name="country">

                          <option value="AFGHANISTAN">AFGHANISTAN</option>

                          <option value="ÅLAND ISLANDS">ÅLAND ISLANDS</option>

                          <option value="ALBANIA">ALBANIA</option>

                          <option value="ALGERIA">ALGERIA</option>

                          <option value="AMERICAN SAMOA">AMERICAN SAMOA</option>

                          <option value="ANDORRA">ANDORRA</option>

                          <option value="ANGOLA">ANGOLA</option>

                          <option value="ANGUILLA">ANGUILLA</option>

                          <option value="ANTARCTICA">ANTARCTICA</option>

                          <option value="ANTIGUA AND BARBUDA">ANTIGUA AND BARBUDA</option>

                          <option value="ARGENTINA">ARGENTINA</option>

                          <option value="ARMENIA">ARMENIA</option>

                          <option value="ARUBA">ARUBA</option>

                          <option value="AUSTRALIA">AUSTRALIA</option>

                          <option value="AUSTRIA">AUSTRIA</option>

                          <option value="AZERBAIJAN">AZERBAIJAN</option>

                          <option value="BAHAMAS">BAHAMAS</option>

                          <option value="BAHRAIN">BAHRAIN</option>

                          <option value="BANGLADESH">BANGLADESH</option>

                          <option value="BARBADOS">BARBADOS</option>

                          <option value="BELARUS">BELARUS</option>

                          <option value="BELGIUM">BELGIUM</option>

                          <option value="BELIZE">BELIZE</option>

                          <option value="BENIN">BENIN</option>

                          <option value="BERMUDA">BERMUDA</option>

                          <option value="BHUTAN">BHUTAN</option>

                          <option value="BOLIVIA">BOLIVIA</option>

                          <option value="BOSNIA AND HERZEGOVINA">BOSNIA AND HERZEGOVINA</option>

                          <option value="BOTSWANA">BOTSWANA</option>

                          <option value="BOUVET ISLAND">BOUVET ISLAND</option>

                          <option value="BRAZIL">BRAZIL</option>

                          <option value="BRITISH INDIAN OCEAN TERRITORY">BRITISH INDIAN OCEAN TERRITORY</option>

                          <option value="BRUNEI DARUSSALAM">BRUNEI DARUSSALAM</option>

                          <option value="BULGARIA">BULGARIA</option>

                          <option value="BURKINA FASO">BURKINA FASO</option>

                          <option value="BURUNDI">BURUNDI</option>

                          <option value="CAMBODIA">CAMBODIA</option>

                          <option value="CAMEROON">CAMEROON</option>

                          <option value="CANADA">CANADA</option>

                          <option value="CAPE VERDE">CAPE VERDE</option>

                          <option value="CAYMAN ISLANDS">CAYMAN ISLANDS</option>

                          <option value="CENTRAL AFRICAN REPUBLIC">CENTRAL AFRICAN REPUBLIC</option>

                          <option value="CHAD">CHAD</option>

                          <option value="CHILE">CHILE</option>

                          <option value="CHINA">CHINA</option>

                          <option value="CHRISTMAS ISLAND">CHRISTMAS ISLAND</option>

                          <option value="COCOS (KEELING) ISLANDS">COCOS (KEELING) ISLANDS</option>

                          <option value="COLOMBIA">COLOMBIA</option>

                          <option value="COMOROS">COMOROS</option>

                          <option value="CONGO">CONGO</option>

                          <option value="CONGO, THE DEMOCRATIC REPUBLIC OF THE">CONGO, THE DEMOCRATIC REPUBLIC OF THE</option>

                          <option value="COOK ISLANDS">COOK ISLANDS</option>

                          <option value="COSTA RICA">COSTA RICA</option>

                          <option value="CÔTE D'IVOIRE">CÔTE D'IVOIRE</option>

                          <option value="CROATIA">CROATIA</option>

                          <option value="CUBA">CUBA</option>

                          <option value="CYPRUS">CYPRUS</option>

                          <option value="CZECH REPUBLIC">CZECH REPUBLIC</option>

                          <option value="DENMARK">DENMARK</option>

                          <option value="DJIBOUTI">DJIBOUTI</option>

                          <option value="DOMINICA">DOMINICA</option>

                          <option value="DOMINICAN REPUBLIC">DOMINICAN REPUBLIC</option>

                          <option value="ECUADOR">ECUADOR</option>

                          <option value="EGYPT">EGYPT</option>

                          <option value="EL SALVADOR">EL SALVADOR</option>

                          <option value="EQUATORIAL GUINEA">EQUATORIAL GUINEA</option>

                          <option value="ERITREA">ERITREA</option>

                          <option value="ESTONIA">ESTONIA</option>

                          <option value="ETHIOPIA">ETHIOPIA</option>

                          <option value="FALKLAND ISLANDS (MALVINAS)">FALKLAND ISLANDS (MALVINAS)</option>

                          <option value="FAROE ISLANDS">FAROE ISLANDS</option>

                          <option value="FIJI">FIJI</option>

                          <option value="FINLAND">FINLAND</option>

                          <option value="FRANCE">FRANCE</option>

                          <option value="FRENCH GUIANA">FRENCH GUIANA</option>

                          <option value="FRENCH POLYNESIA">FRENCH POLYNESIA</option>

                          <option value="FRENCH SOUTHERN TERRITORIES">FRENCH SOUTHERN TERRITORIES</option>

                          <option value="GABON">GABON</option>

                          <option value="GAMBIA">GAMBIA</option>

                          <option value="GEORGIA">GEORGIA</option>

                          <option value="GERMANY">GERMANY</option>

                          <option value="GHANA">GHANA</option>

                          <option value="GIBRALTAR">GIBRALTAR</option>

                          <option value="GREECE">GREECE</option>

                          <option value="GREENLAND">GREENLAND</option>

                          <option value="GRENADA">GRENADA</option>

                          <option value="GUADELOUPE">GUADELOUPE</option>

                          <option value="GUAM">GUAM</option>

                          <option value="GUATEMALA">GUATEMALA</option>

                          <option value="GUINEA">GUINEA</option>

                          <option value="GUINEA-BISSAU">GUINEA-BISSAU</option>

                          <option value="GUYANA">GUYANA</option>

                          <option value="HAITI">HAITI</option>

                          <option value="HEARD ISLAND AND MCDONALD ISLANDS">HEARD ISLAND AND MCDONALD ISLANDS</option>

                          <option value="HOLY SEE (VATICAN CITY STATE)">HOLY SEE (VATICAN CITY STATE)</option>

                          <option value="HONDURAS">HONDURAS</option>

                          <option value="HONG KONG">HONG KONG</option>

                          <option value="HUNGARY">HUNGARY</option>

                          <option value="ICELAND">ICELAND</option>

                          <option value="INDIA">INDIA</option>

                          <option value="INDONESIA">INDONESIA</option>

                          <option value="IRAN, ISLAMIC REPUBLIC OF">IRAN, ISLAMIC REPUBLIC OF</option>

                          <option value="IRAQ">IRAQ</option>

                          <option value="IRELAND">IRELAND</option>

                          <option value="ISRAEL">ISRAEL</option>

                          <option value="ITALY">ITALY</option>

                          <option value="JAMAICA">JAMAICA</option>

                          <option value="JAPAN">JAPAN</option>

                          <option value="JORDAN">JORDAN</option>

                          <option value="KAZAKHSTAN">KAZAKHSTAN</option>

                          <option value="KENYA">KENYA</option>

                          <option value="KIRIBATI">KIRIBATI</option>

                          <option value="KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF">KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF</option>

                          <option value="KOREA, REPUBLIC OF">KOREA, REPUBLIC OF</option>

                          <option value="KUWAIT">KUWAIT</option>

                          <option value="KYRGYZSTAN">KYRGYZSTAN</option>

                          <option value="LAO PEOPLE'S DEMOCRATIC REPUBLIC">LAO PEOPLE'S DEMOCRATIC REPUBLIC</option>

                          <option value="LATVIA">LATVIA</option>

                          <option value="LEBANON">LEBANON</option>

                          <option value="LESOTHO">LESOTHO</option>

                          <option value="LIBERIA">LIBERIA</option>

                          <option value="LIBYAN ARAB JAMAHIRIYA">LIBYAN ARAB JAMAHIRIYA</option>

                          <option value="LIECHTENSTEIN">LIECHTENSTEIN</option>

                          <option value="LITHUANIA">LITHUANIA</option>

                          <option value="LUXEMBOURG">LUXEMBOURG</option>

                          <option value="MACAO">MACAO</option>

                          <option value="MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF">MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF</option>

                          <option value="MADAGASCAR">MADAGASCAR</option>

                          <option value="MALAWI">MALAWI</option>

                          <option value="MALAYSIA">MALAYSIA</option>

                          <option value="MALDIVES">MALDIVES</option>

                          <option value="MALI">MALI</option>

                          <option value="MALTA">MALTA</option>

                          <option value="MARSHALL ISLANDS">MARSHALL ISLANDS</option>

                          <option value="MARTINIQUE">MARTINIQUE</option>

                          <option value="MAURITANIA">MAURITANIA</option>

                          <option value="MAURITIUS">MAURITIUS</option>

                          <option value="MAYOTTE">MAYOTTE</option>

                          <option value="MEXICO">MEXICO</option>

                          <option value="MICRONESIA, FEDERATED STATES OF">MICRONESIA, FEDERATED STATES OF</option>

                          <option value="MOLDOVA, REPUBLIC OF">MOLDOVA, REPUBLIC OF</option>

                          <option value="MONACO">MONACO</option>

                          <option value="MONGOLIA">MONGOLIA</option>

                          <option value="MONTSERRAT">MONTSERRAT</option>

                          <option value="MOROCCO">MOROCCO</option>

                          <option value="MOZAMBIQUE">MOZAMBIQUE</option>

                          <option value="MYANMAR">MYANMAR</option>

                          <option value="NAMIBIA">NAMIBIA</option>

                          <option value="NAURU">NAURU</option>

                          <option value="NEPAL">NEPAL</option>

                          <option value="NETHERLANDS">NETHERLANDS</option>

                          <option value="NETHERLANDS ANTILLES">NETHERLANDS ANTILLES</option>

                          <option value="NEW CALEDONIA">NEW CALEDONIA</option>

                          <option value="NEW ZEALAND">NEW ZEALAND</option>

                          <option value="NICARAGUA">NICARAGUA</option>

                          <option value="NIGER">NIGER</option>

                          <option value="NIGERIA">NIGERIA</option>

                          <option value="NIUE">NIUE</option>

                          <option value="NORFOLK ISLAND">NORFOLK ISLAND</option>

                          <option value="NORTHERN MARIANA ISLANDS">NORTHERN MARIANA ISLANDS</option>

                          <option value="NORWAY">NORWAY</option>

                          <option value="OMAN">OMAN</option>

                          <option value="PAKISTAN">PAKISTAN</option>

                          <option value="PALAU">PALAU</option>

                          <option value="PALESTINIAN TERRITORY, OCCUPIED">PALESTINIAN TERRITORY, OCCUPIED</option>

                          <option value="PANAMA">PANAMA</option>

                          <option value="PAPUA NEW GUINEA">PAPUA NEW GUINEA</option>

                          <option value="PARAGUAY">PARAGUAY</option>

                          <option value="PERU">PERU</option>

                          <option value="PHILIPPINES">PHILIPPINES</option>

                          <option value="PITCAIRN">PITCAIRN</option>

                          <option value="POLAND">POLAND</option>

                          <option value="PORTUGAL">PORTUGAL</option>

                          <option value="PUERTO RICO">PUERTO RICO</option>

                          <option value="QATAR">QATAR</option>

                          <option value="RÉUNION">RÉUNION</option>

                          <option value="ROMANIA">ROMANIA</option>

                          <option value="RUSSIAN FEDERATION">RUSSIAN FEDERATION</option>

                          <option value="RWANDA">RWANDA</option>

                          <option value="SAINT HELENA">SAINT HELENA</option>

                          <option value="SAINT KITTS AND NEVIS">SAINT KITTS AND NEVIS</option>

                          <option value="SAINT LUCIA">SAINT LUCIA</option>

                          <option value="SAINT PIERRE AND MIQUELON">SAINT PIERRE AND MIQUELON</option>

                          <option value="SAINT VINCENT AND THE GRENADINES">SAINT VINCENT AND THE GRENADINES</option>

                          <option value="SAMOA">SAMOA</option>

                          <option value="SAN MARINO">SAN MARINO</option>

                          <option value="SAO TOME AND PRINCIPE">SAO TOME AND PRINCIPE</option>

                          <option value="SAUDI ARABIA">SAUDI ARABIA</option>

                          <option value="SENEGAL">SENEGAL</option>

                          <option value="SERBIA AND MONTENEGRO">SERBIA AND MONTENEGRO</option>

                          <option value="SEYCHELLES">SEYCHELLES</option>

                          <option value="SIERRA LEONE">SIERRA LEONE</option>

                          <option value="SINGAPORE">SINGAPORE</option>

                          <option value="SLOVAKIA">SLOVAKIA</option>

                          <option value="SLOVENIA">SLOVENIA</option>

                          <option value="SOLOMON ISLANDS">SOLOMON ISLANDS</option>

                          <option value="SOMALIA">SOMALIA</option>

                          <option value="SOUTH AFRICA">SOUTH AFRICA</option>

                          <option value="SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS">SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS</option>

                          <option value="SPAIN">SPAIN</option>

                          <option value="SRI LANKA">SRI LANKA</option>

                          <option value="SUDAN">SUDAN</option>

                          <option value="SURINAME">SURINAME</option>

                          <option value="SVALBARD AND JAN MAYEN">SVALBARD AND JAN MAYEN</option>

                          <option value="SWAZILAND">SWAZILAND</option>

                          <option value="SWEDEN">SWEDEN</option>

                          <option value="SWITZERLAND">SWITZERLAND</option>

                          <option value="SYRIAN ARAB REPUBLIC">SYRIAN ARAB REPUBLIC</option>

                          <option value="TAIWAN, PROVINCE OF CHINA">TAIWAN, PROVINCE OF CHINA</option>

                          <option value="TAJIKISTAN">TAJIKISTAN</option>

                          <option value="TANZANIA, UNITED REPUBLIC OF">TANZANIA, UNITED REPUBLIC OF</option>

                          <option value="THAILAND">THAILAND</option>

                          <option value="TIMOR-LESTE">TIMOR-LESTE</option>

                          <option value="TOGO">TOGO</option>

                          <option value="TOKELAU">TOKELAU</option>

                          <option value="TONGA">TONGA</option>

                          <option value="TRINIDAD AND TOBAGO">TRINIDAD AND TOBAGO</option>

                          <option value="TUNISIA">TUNISIA</option>

                          <option value="TURKEY">TURKEY</option>

                          <option value="TURKMENISTAN">TURKMENISTAN</option>

                          <option value="TURKS AND CAICOS ISLANDS">TURKS AND CAICOS ISLANDS</option>

                          <option value="TUVALU">TUVALU</option>

                          <option value="UGANDA">UGANDA</option>

                          <option value="UKRAINE">UKRAINE</option>

                          <option value="UNITED ARAB EMIRATES">UNITED ARAB EMIRATES</option>

                          <option value="UNITED KINGDOM">UNITED KINGDOM</option>

                          <option value="UNITED STATES">UNITED STATES</option>

                          <option value="UNITED STATES MINOR OUTLYING ISLANDS">UNITED STATES MINOR OUTLYING ISLANDS</option>

                          <option value="URUGUAY">URUGUAY</option>

                          <option value="UZBEKISTAN">UZBEKISTAN</option>

                          <option value="VANUATU">VANUATU</option>

                          <option value="VENEZUELA">VENEZUELA</option>

                          <option value="VIET NAM">VIET NAM</option>

                          <option value="VIRGIN ISLANDS, BRITISH">VIRGIN ISLANDS, BRITISH</option>

                          <option value="VIRGIN ISLANDS, U.S.">VIRGIN ISLANDS, U.S.</option>

                          <option value="WALLIS AND FUTUNA">WALLIS AND FUTUNA</option>

                          <option value="WESTERN SAHARA ')">WESTERN SAHARA ')</option>

                          <option value="YEMEN">YEMEN</option>

                          <option value="ZAMBIA">ZAMBIA</option>

                          <option value="ZIMBABWE">ZIMBABWE</option>

                          </select>

                </div>
              </div>
              <div class="form-group  col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label>Number Type:</label>
                  <div class="container" style="    display: inline-flex;">
                    <div class="radio">
                      <input id="numType-1" name="number_type" type="radio" value="Local DID" checked>
                      <label for="numType-1" class="radio-label">Local DID</label>
                    </div>
                    <div class="radio">
                      <input id="numType-2" name="number_type" type="radio" value="Toll Free">
                      <label for="numType-2" class="radio-label">Toll Free</label>
                    </div>
                    <div class="radio">
                      <input id="numType-3" name="number_type" type="radio" value="Both">
                      <label for="numType-3" class="radio-label">Both (extra cost may apply)</label>
                    </div>
                  </div>
                </div>

              </div>

              <div class="form-group  col-md-6 col-sm-6 col-xs-12">
                <label for="message">Comments: </label>
                <textarea id="message" class="form-control" name="comments" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100"
                  data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"></textarea>
              </div>
              <div class="form-group  col-md-6 col-sm-6 col-xs-12">
                <label for="message">Submit: </label><br>
                <button type="submit" class="btn btn-success" id="sendRequest">Send Request </button>
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12 ">

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{!! asset('vendors/jquery/dist/jquery.min.js') !!}"></script>
  @include('comman.plugins')
  <script src="{!! asset('js/custom/administrator/administrator_requestnumber.js') !!}"></script>

  <style>
    .radio {
      margin: 0.5rem;
    }

    .radio input[type="radio"] {
      position: absolute;
      opacity: 0;
    }

    .radio input[type="radio"]+.radio-label:before {
      content: '';
      background: #f4f4f4;
      border-radius: 100%;
      border: 1px solid #b4b4b4;
      display: inline-block;
      width: 1.4em;
      height: 1.4em;
      position: relative;
      top: -0.2em;
      margin-right: 1em;
      vertical-align: top;
      cursor: pointer;
      text-align: center;
      transition: all 250ms ease;
    }

    .radio input[type="radio"]:checked+.radio-label:before {
      background-color: #3197ee;
      box-shadow: inset 0 0 0 4px #f4f4f4;
    }

    .radio input[type="radio"]:focus+.radio-label:before {
      outline: none;
      border-color: #3197ee;
    }

    .radio input[type="radio"]:disabled+.radio-label:before {
      box-shadow: inset 0 0 0 4px #f4f4f4;
      border-color: #b4b4b4;
      background: #b4b4b4;
    }

    #requestform {
      display: block;
      /* background-color: #eee; */
      margin-left: auto;
      margin-right: auto;
      /* text-align: center; */
      margin-left: 10%;

      .radio input[type="radio"]+.radio-label:empty:before {
        margin-right: 0;
      }

    }
  </style>
@endsection