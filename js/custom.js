$("input").keyup(function () {
    console.log('up');
    // $("input").css("background-color", "pink");
});
function drawChart(data, id) {
    var data = google.visualization.arrayToDataTable([
        ['Invested Amount', 'Estimated Returns'],
        ['Estimated Returns', data.b],
        ['Invested Amount', data.a],
    ]);
    var formatter = new google.visualization.NumberFormat(
        { pattern: '₹##,##,###' });
    formatter.format(data, 1);
    var options = {
        title: '',
        pieSliceText: 'value',
        is3D: true
    };
    var chart = new google.visualization.PieChart(document.getElementById(id));
    chart.draw(data, options);
}
function showResultSIP(f) {
    var validation = ValidateForm(f);

    if (validation == true) {
        var formId = "piechartSIP";
        var form = f[0];
        var formData = new FormData(form);
        var dataGraph = {};

        $.ajax({
            type: 'post',
            url: 'calcSIP.php',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (result) {
                var data = JSON.parse(result);
                document.getElementById("totalInvestment1").textContent = data.totalInvestment.toLocaleString('en-IN', { maximumFractionDigits: 2, currency: 'INR' });;
                document.getElementById("wealthGained1").textContent = data.wealthGained.toLocaleString('en-IN', { maximumFractionDigits: 2, currency: 'INR' });;
                document.getElementById("maturityValue").textContent = data.maturityValue.toLocaleString('en-IN', { maximumFractionDigits: 2, currency: 'INR' });;

                dataGraph['a'] = data.totalInvestment;
                dataGraph['b'] = data.wealthGained;

                google.charts.load('current', { 'packages': ['corechart'] });
                google.charts.setOnLoadCallback(() => drawChart(dataGraph, formId));
            }
        })

        document.getElementById("resultSIP").style.display = 'block';
    }
}
function sendError(ele, msg) {
    $('.error').remove();

    $(':input').css('border', '');
    //$('<div class="error">' + msg + '</div>').insertAfter(ele);
    $(ele).focus().css('border', 'solid 1px red');
    $(ele).addClass("errorshake");

    return false;
}
function ValidateForm(obj) {
    var valid = true;

    var ele = $(obj).find('input[type=text],input[type=number],input[type=checkbox],textarea,select')
    $(ele).each(function (i, value) {
        var name = $(this).attr('name');
        var value = $(this).val();

        $(this).find('.errorshake').removeClass("errorshake");
        $(this).parent().find('.error').remove();
        if ($(this).is(":visible")) {
            if ($(this).is('select') && value == '') {
                valid = sendError(this, 'Please Select This Option');
            } else {
                if (name != 'phone_student') {
                    if (value == '') {
                        valid = sendError(this, 'Please Provide Valid Information ddd')
                    }
                }
            }
        }
        return valid;
    });
    return valid;
}
function showResultSIPReverse(f) {
    var validation = ValidateForm(f);

    if (validation == true) {
        var formId = "piechartSIPReverse";
        var form = f[0];
        var formData = new FormData(form);
        var dataGraph = {};

        $.ajax({
            type: 'post',
            url: 'calcSIPReverse.php',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (result) {
                var data = JSON.parse(result);
                document.getElementById("totalInvestment2").textContent = Number(data.totalInvestment).toLocaleString('en-IN', { maximumFractionDigits: 2, currency: 'INR' });;
                document.getElementById("monthlyInvestment").textContent = data.monthlyInvestment.toLocaleString('en-IN', { maximumFractionDigits: 2, currency: 'INR' });;

                dataGraph['a'] = data.totalInvestment;
                dataGraph['b'] = Number(data.targetAmount);

                google.charts.load('current', { 'packages': ['corechart'] });
                google.charts.setOnLoadCallback(() => drawChart(dataGraph, formId));
            }
        })

        document.getElementById("resultSIPReverse").style.display = 'block';
    }
}
function showResultLumpsum(f) {
    var validation = ValidateForm(f);

    if (validation == true) {
        var formId = "piechartLumpsum";
        var form = f[0];
        var formData = new FormData(form);
        var dataGraph = {};

        $.ajax({
            type: 'post',
            url: 'calcLumpsum.php',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (result) {
                var data = JSON.parse(result);
                document.getElementById("resultAmountInvested2").textContent = Number(data.amount).toLocaleString('en-IN', { maximumFractionDigits: 2, currency: 'INR' });;
                document.getElementById("resultAmountExpected").textContent = data.amountExpected.toLocaleString('en-IN', { maximumFractionDigits: 2, currency: 'INR' });;
                document.getElementById("resultWealthGained").textContent = data.wealthGained.toLocaleString('en-IN', { maximumFractionDigits: 2, currency: 'INR' });;

                dataGraph['a'] = Number(data.amount);
                dataGraph['b'] = data.amountExpected;

                google.charts.load('current', { 'packages': ['corechart'] });
                google.charts.setOnLoadCallback(() => drawChart(dataGraph, formId));
            }
        })


        document.getElementById("resultLumpsum").style.display = 'block';
    }
}