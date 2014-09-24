        $(document).ready(function () {
            function displayWarning() {
                $('#btc-api-warning').css("visibility", "visible");
                $('#btc-api-warning').show();
                $('#balance-container').hide();
            }

            function doUpdate(response) {
                var goal = $('#funding-goal').text();
                var fundAddress = $('#funding-address').text();
                var fundFloor = $('#funding-floor').text();
                if (response.addrStr != fundAddress) {
                    displayWarning();
                }
                $('#btc-api-warning').hide();
                $('#btc-api-warning').css("visibility", "hidden");
                $('#balance-container').show();
                totalReceived = Math.round((response.totalReceived - fundFloor) * 100000000) / 100000000;
                totalRemaining = Math.round((goal - totalReceived) * 100000000) / 100000000;
                $('#btc-total-received').html(totalReceived);
                $('#btc-total-remaining').html(totalRemaining);
                $('#btc-unconfirmed-balance').html(response.unconfirmedBalance);


                // Determinate progress bar
                var pBar = document.getElementById('pbar');
                var val = document.getElementById('v');
                var updateProgress = function (value) {
                    var percent = Math.floor((100 / goal) * value)
                    pBar.value = percent;
                    pBar.getElementsByTagName('span')[0].innerHTML = percent;
                    val.innerHTML = percent + '%';
                }

                updateProgress(totalReceived);

                if (response.unconfirmedBalance <= 0) {
                    $('#unconfirmed-container').hide();
                } else {
                    $('#unconfirmed-container').show();
                }
            }

            function updateBalance() {
                var fundAddress = $('#funding-address').text();
                $.get('https://insight.bitpay.com/api/addr/'+fundAddress+'?noTxList=1').fail(function (response, message, xhr) {
                    displayWarning();
                }).done(function (response, message, xhr) {
                    doUpdate(response);
                });
            }

            // on document load:
            updateBalance();
            // on manual refresh:
            $('#refresh-balance').on('click', function (event) {
                event.preventDefault();
                updateBalance();
            });
        });
