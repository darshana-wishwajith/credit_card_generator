<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credit Card Generator</title>

    <link rel="shortcut icon" href="images/chip.png" type="image/x-icon">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">

</head>

<body class="bg-body-secondary">
    <?php include "mysql_connector.php" ?>

    <div class="container">
        <div class="row mt-4">
            <div class="col-12 col-md-6">
                <div class="form-control p-4 mb-4">

                    <h1 class="fw-bold heading mt-4 text-center">VIRTUAL CARD GENERATOR</h1>
                    <p class="text-center mb-5">Make your virtual card with your details instantly</p>

                    <div class="row">
                        <div class="col-6">
                            <div class="mkBtn active text-center" id="mkBtn">Make</div>
                        </div>
                        <div class="col-6">
                            <div class="shBtn text-center" id="shBtn">Search</div>
                        </div>
                    </div>

                    <div class="form-control p-3" id="make">
                        <div class="row">
                            <div class="col-6 g-3">
                                <label for="cardType" class="form-label">Card Type :</label>
                                <select class="form-select" id="cardType">
                                    <option value="0">Select</option>
                                    <?php
                                    $ct_rs = Database::search("SELECT * FROM `card_type`");
                                    $ct_num = $ct_rs->num_rows;

                                    for ($i = 0; $i < $ct_num; $i++) {
                                        $ct_data = $ct_rs->fetch_assoc();

                                    ?>
                                        <option value="<?php echo $ct_data['id'] ?>"><?php echo $ct_data['type_name'] ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="col-6 g-3">
                                <label for="cardNetwork" class="form-label">Card Network :</label>
                                <select class="form-select" id="cardNetwork">
                                    <option value="0">Select</option>

                                    <?php
                                    $cn_rs = Database::search("SELECT * FROM `card_network`");
                                    $cn_num = $cn_rs->num_rows;

                                    for ($x = 0; $x < $cn_num; $x++) {
                                        $cn_data = $cn_rs->fetch_assoc();

                                    ?>
                                        <option value="<?php echo $cn_data['id'] ?>"><?php echo $cn_data['network_name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 g-3">
                                <label for="hName" class="form-label">Holder's Name :</label>
                                <input type="text" class="form-control" id="hName" placeholder="ex : H M A HERATH">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 g-3">
                                <label for="cvv" class="form-label">CVV Number :</label>
                                <input type="number" class="form-control" id="cvv" placeholder="3 Digit Number" maxlength="3" minlength="3">
                            </div>
                            <div class="col-6 g-3">
                                <label for="exDate" class="form-label">Expire Date :</label>
                                <input type="date" class="form-control" id="exDate">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 g-3">
                                <label for="pw" class="form-label">Password :</label>
                                <input type="password" id="pw" class="form-control" placeholder="Set unique password for each card">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6 g-3 d-grid">
                                <button class="btn btn-danger" id="clearBtn">Clear</button>
                            </div>
                            <div class="col-6 g-3 d-grid">
                                <button class="btn btn-success" id="generateBtn">Generate</button>
                            </div>
                        </div>
                    </div>

                    <div class="form-control p-3 d-none" id="search">
                        <div class="row">
                            <div class="col-12 g-3">
                                <label for="hName2" class="form-label">Holder's Name :</label>
                                <input type="text" class="form-control" id="hName2" placeholder="ex : H M A HERATH">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 g-3">
                                <label for="pw2" class="form-label">Password :</label>
                                <input type="password" class="form-control" id="pw2">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 g-3 d-grid">
                                <button class="btn btn-success" id="searchBtn">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 container">
                <div class="card">
                    <div class="card-inner">
                        <div class="front">
                            <img src="images/map.png" class="map-img">

                            <div class="row">
                                <div class="d-flex justify-content-between">
                                    <p class="fs-4 fw-bold">MyPay</p>
                                    <p>International <span id="ct">Credit</span> &nbsp;<img class="nfc" src="images/nfc2.png" height="30px"></p>
                                </div>
                            </div>

                            <div class="row d-flex justify-content-between">
                                <img src="images/chip.png" class="chip">
                            </div>

                            <div class="row">
                                <div class="d-flex justify-content-between card-no">
                                    <p id="cn_group_0">5781</p>
                                    <p id="cn_group_4">8456</p>
                                    <p id="cn_group_8">9635</p>
                                    <p id="cn_group_12">7125</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="d-flex justify-content-end card-holder">
                                    <p>VALID THRU</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="d-flex justify-content-end card-holder-name">
                                    <p><span id="month">01</span>/<span id="year">24</span></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="d-flex justify-content-between network">
                                    <div class="row">
                                        <p class="card-holder">CARD HOLDER</p>
                                        <p class="card-holder-name" id="holder">H M A HERATH</p>
                                    </div>
                                    <img src="images/visa.png" height="30px" id="network_logo">
                                </div>
                            </div>
                        </div>
                        <div class="back">
                            <img src="images/map.png" class="map-img">
                            <div class="row">
                                <div class="hotline">
                                    <p>For Customer Service, Please call +94 112 243 543</p>
                                    <p>MCTP13065234</p>
                                </div>
                            </div>
                                <div class="bar"></div>
                                <div class="row">
                                    <div class="col-10">
                                        <img src="images/pattern.png" class="ptn">
                                    </div>
                                    <div class="col-2">
                                        <p class="cvv" id="cvv_num">345</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <p class="signature text-center">AUTHORIZED SIGNATURE - NOT VALID UNTIL SIGNED</p>
                                </div>

                                <div class="row">
                                    <p class=" card-text">By using this card the holder agrees to all terms under which it was issued. Can't be used at ATMs. **This is for educational purposes only</p>
                                </div>

                                <div class="row">
                                    <div class="d-flex justify-content-between card-bottom">
                                        <img src="images/visa.png" height="30px" id="network_logo2">
                                        <p class="fs-4 fw-bold">MyPay</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>
    <br><br>
    <p class="text-center" style="font-size: 12px;">Darshana Wishwajith @ 2024</p>
    <script src="script.js"></script>
    <script src="bootstrap/bootstrap.js"></script>
</body>

</html>