<html>

    <head>
        <style>
            .main-container{
                background: black;
                border-style: solid;
                width: 100%;
                height: 100%;
                border-color: burlywood;
                border-width: 5px;
            }
            #dropdown {
                width: 160px;
                height: 40px;
                position: relative;
                font-size: 20px;
            }

            fieldset {
                font-family: papyrus;
                font-size: 20px;
                color:white;
                border-bottom-left-radius: 10%;
                border-bottom-right-radius: 10%;
                border-top-right-radius: 10%;
                border: 10px solid white;
            }

            #click-hard {
                height: 45px;
            }
            #one-window {
                display: none;
            }
            #first-one {
                color: white;
                border-style: solid;
            }
            #two-window {
                color: white;
                border-style: solid;
                display: none;
            }
            #three-window {
                color: white;
                border-style: solid;
                display: none;
            }
            #four-window {
                color: white;
                border-style: solid;
                display: none;
            }
            table.one-window {
                height: 85%;
                width: 100%;
                border-collapse:collapse;
                text-align: center;
                font-weight: bold;
                font-size: 50px;
                font-family: papyrus;
                color: yellow;
            }

            td.empty {
                padding:10px;
                border-style:solid;
                border-width:10px;
                border-color:yellow;
            }



        </style>
    </head>

    <body>

        <div class="main-container">
            <center>
                <fieldset>
                    <legend><a id="type-of-window">Select the type of window</a></legend>
                    <button id="click-hard" onclick="clickHardButton()">Hit me hard!!!</button>
                    <select id="dropdown">
                            <option value="one_window">One Window</option>
                            <option value="two_window">Two Window</option>
                            <option value="three_window">Three Window</option>
                            <option value="four_window">Four Window</option>
                    </select>
                </fieldset>
            </center>

            <div id="one-window">
                <center>
        <table class="one-window">
            <tr>
                <td class="empty" name="huhu">34</td>
            </tr>
            <tr>
                <td class="empty">Cashier Window 1</td>
            </tr>
            <tr>
                <td class="empty">Total queuer: 45</td>
            </tr>
            </table>
    </center>
            </div>
            <div id="two-window">
                    <div id="first-two">First window</div>
                    <div id="second-two">Second window</div>
            </div>
            <div id="three-window">
                    <div id="first-three">First window</div>
                    <div id="second-three">Second window</div>
                    <div id="third-three">Third window</div>
            </div>
            <div id="four-window">
                    <div id="first-four">First window</div>
                    <div id="second-four">Second window</div>
                    <div id="third-four">Third window</div>
                    <div id="fourth-four">Fourth window</div>
            </div>






        </div>


        <script>
            function clickHardButton() {
                var optionSelected = document.getElementById("dropdown").value;

                if (optionSelected == "one_window") {
                    windowOne();
                }
                else if (optionSelected == "two_window") {
                    windowTwo();
                }
                else if (optionSelected == "three_window") {
                    windowThree();
                }
                else if (optionSelected == "four_window") {
                    windowFour();
                }
                else {
                    alert("You dont select at all.");
                }

                function windowOne() {
                    $('#one-window').show();
                    $('#two-window').hide();
                    $('#three-window').hide();
                    $('#four-window').hide();
                }
                function windowTwo() {
                    $('#one-window').hide();
                    $('#two-window').show();
                    $('#three-window').hide();
                    $('#four-window').hide();
                }
                function windowThree() {
                    $('#one-window').hide();
                    $('#two-window').hide();
                    $('#three-window').show();
                    $('#four-window').hide();
                }
                function windowFour() {
                    $('#one-window').hide();
                    $('#two-window').hide();
                    $('#three-window').hide();
                    $('#four-window').show();
                }

            }
        </script>
        <!-- <script src="jquery-3.2.1.min.js"></script> -->
        <script src="<?php echo base_url('assets/js/jquery-3.2.1.js'); ?>"></script>

    </body>

</html>
