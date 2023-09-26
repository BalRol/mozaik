<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Your App Name</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
        .selected {
          background-color: #f0f0f0;
        }
      </style>
</head>
<body>
    <header class="bg-primary py-3 text-center text-white">
        <div class="container">
            <h1>Competition manager</h1>
        </div>
    </header>
    <main class="container mt-4">
    <div class="competition form">
        <h1>Competition List</h1>
            <table class="table" id="competitionTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Year</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        <div class="mb-3">
            <input type="text" id="competitionName" class="form-control m-1" placeholder="Name">
            <input type="text" id="competitionYear" class="form-control m-1" placeholder="Year">
            <input type="text" id="competitionLocation" class="form-control m-1" placeholder="Location"><br>
            <button id="addCompetition" class="btn btn-primary">Add Competition</button>
            <button id="delCompetition" class="btn btn-danger" disabled = true>Delete Competition</button>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        </div>
        <div class="round mt-5">
        <h1>Round List</h1>
            <table class="table" id="roundTable">
                <thead>
                    <tr>
                        <th hidden>ID</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        <div class="mb-3">
            <input type="text" class="form-control m-1" id="roundName" placeholder="Name">
            <input type="text" class="form-control m-1" id="roundLocation" placeholder="Location">
            <input type="text" class="form-control m-1" id="roundDate" placeholder="Date">
            <button id="addRound" class="btn btn-primary">Add Round</button>
            <button id="delRound" class="btn btn-danger" disabled = true>Delete Round</button>
        </div>
        </div>
        <div class="competitor mt-5">
        <h1>Competitor List</h1>
            <table class="table" id="competitorTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div  class="mb-3">
                <select  class="form-select p-1 mb-2" id="competitiorUser" ></select><br>
                <button class="btn btn-primary" id="addCompetitor">Add Competitor</button>
                <button class="btn btn-danger" id="delCompetitor" disabled = true>Delete Competitor</button>
            </div>
        </div>
    </main>
    <script>
        var competition_location_selected, competition_year_selected, competition_name_selected;
        var round_id_selected, round_name_selected,round_location_selected, round_date_selected;
        var competitor_name_tmp, competitor_email_tmp, competitor_round_tmp;
        var competitor_name_selected, competitor_email_selected;
        var user_name_tmp, user_email_tmp;
        var competitions = [];
        $(document).ready(function() {
            $('.round').hide();
            competitionAjax();
            $('#delCompetition').click(function(){
                competitionAjaxDel();
            });
            $('#addCompetition').click(function(){
                competitionAjaxAdd();
            });
        });
        function competitionInitTable() {
            $(document).ready(function() {
                $('#competitionTable tbody tr').click(function() {
                    $(this).addClass('selected').siblings().removeClass('selected');
                    competition_name_selected = $(this).find('td:eq(0)').text();
                    competition_year_selected = $(this).find('td:eq(1)').text();
                    competition_location_selected = $(this).find('td:eq(2)').text();

                    if ($('#competitionTable tbody tr').hasClass('selected')) {
                        $('#delCompetition').prop('disabled', false); // Aktiváljuk a gombot
                    } else {
                        $('#delCompetition').prop('disabled', true); // Letiltjuk a gombot
                    }
                    $('.round').show();
                    roundAjax();
                });
                if ($('#competitionTable tbody tr').hasClass('selected')) {
                    $('#delCompetition').prop('disabled', false); // Aktiváljuk a gombot
                } else {
                    $('#delCompetition').prop('disabled', true); // Letiltjuk a gombot
                }
            });
        };
        function competitionAjax(){
            $.ajax({
                url: '/competitions',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#competitionTable tbody').html("");
                    $.each(data, function(index, competition) {
                        $('#competitionTable tbody').append(`
                            <tr>
                                <td id="${competition.name.toLowerCase()}">${competition.name}</td>
                                <td id="${competition.year.toLowerCase()}">${competition.year}</td>
                                <td id="${competition.location.toLowerCase()}">${competition.location}</td>
                            </tr>
                        `);
                    });
                    competitionInitTable();
                },
                error: function() {
                    alert('Sikertelen volt az adatok betöltése.');
                }
            });
        }
        function competitionAjaxDel(){
            var competitionDelParams = {
                name : competition_name_selected,
                year : competition_year_selected
            };
            $.ajax({
                url: '/competitionDel',
                type: 'DELETE',
                dataType: 'json',
                data: competitionDelParams,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    competitionAjax();
                    $('.round').hide();
                },
                error: function() {
                    alert('Sikertelen volt az adat törlése');
                }
            });
        }
        function competitionAjaxAdd(){
            var competitionAddParams = {
                name : $('#competitionName').val(),
                year : $('#competitionYear').val(),
                location : $('#competitionLocation').val()
            };
            $.ajax({
                url: '/competitionAdd',
                type: 'POST',
                dataType: 'json',
                data: competitionAddParams,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    competitionAjax();
                },
                error: function() {
                    alert('Sikertelen volt az adat hozzáadása');
                }
            });
            $('#competitionName').val('');
            $('#competitionYear').val('');
            $('#competitionLocation').val('');
        }
        $(document).ready(function() {
            $('.competitor').hide();
            roundInitTable();
            $('#delRound').click(function(){
                roundAjaxDel();
            });
            $('#addRound').click(function(){
                roundAjaxAdd();
            });
        });
        function roundInitTable() {
            $(document).ready(function() {
                $('#roundTable tbody tr').click(function() {
                    $(this).addClass('selected').siblings().removeClass('selected');
                    round_id_selected = $(this).find('td:eq(0)').text();
                    round_name_selected = $(this).find('td:eq(1)').text();
                    round_location_selected = $(this).find('td:eq(2)').text();
                    round_date_selected = $(this).find('td:eq(3)').text();
                    if ($('#roundTable tbody tr').hasClass('selected')) {
                        $('#delRound').prop('disabled', false);
                    } else {
                        $('#delRound').prop('disabled', true);
                    }
                    $('.competitor').show();
                    competitorAjax();
                });
                if ($('#roundTable tbody tr').hasClass('selected')) {
                    $('#delRound').prop('disabled', false);
                } else {
                    $('#delRound').prop('disabled', true);
                }
            });
        };
        function roundAjax(){
            var competitionParams = {
                name : competition_name_selected,
                year : competition_year_selected
            };
            $.ajax({
                url: '/rounds',
                type: 'GET',
                dataType: 'json',
                data: competitionParams,
                success: function(data) {
                    var options="";
                    var competition_name_tmp, competition_year_tmp;
                    $('#roundTable tbody').html("");
                    $('#competitorTable tbody').html("");
                    $('.competitor').hide();
                    $.each(data, function(index, round) {
                        $('#roundTable tbody').append(`
                            <tr>
                                <td hidden>${round.id}</td>
                                <td>${round.name}</td>
                                <td>${round.location}</td>
                                <td>${round.date}</td>
                            </tr>
                        `);
                    });
                    roundInitTable();
                },
                error: function() {
                    alert('Sikertelen volt az adatok betöltése.');
                }
            });
        }
        function roundAjaxDel(){
            var roundDelParams = {
                id : round_id_selected
            };
            $.ajax({
                url: '/roundDel',
                type: 'DELETE',
                dataType: 'json',
                data: roundDelParams,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    roundAjax();
                    $('.competitor').hide();
                },
                error: function() {
                    alert('Sikertelen volt az adat törlése');
                }
            });
        }
        function roundAjaxAdd(){
            var roundAddParams = {
                name : $('#roundName').val(),
                location : $('#roundLocation').val(),
                date : $('#roundDate').val(),
                competition_name : competition_name_selected,
                competition_year : competition_year_selected
            };
            $.ajax({
                url: '/roundAdd',
                type: 'POST',
                dataType: 'json',
                data: roundAddParams,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    roundAjax();
                },
                error: function() {
                    alert('Sikertelen volt az adat hozzáadása.');
                }
            });
            $('#roundName').val('');
            $('#roundLocation').val('');
            $('#roundDate').val('');
        }

        $(document).ready(function() {
            competitorInitTable();
            $('#delCompetitor').click(function(){
                competitorAjaxDel();
            });
            $('#addCompetitor').click(function(){
                competitorAjaxAdd();
            });
        });
        function competitorInitTable() {
            $(document).ready(function() {
                $('#competitorTable tbody tr').click(function() {
                    $(this).addClass('selected').siblings().removeClass('selected');
                    competitor_name_selected = $(this).find('td:eq(0)').text();
                    competitor_email_selected = $(this).find('td:eq(1)').text();
                    if ($('#competitorTable tbody tr').hasClass('selected')) {
                        $('#delCompetitor').prop('disabled', false);
                    } else {
                        $('#delCompetitor').prop('disabled', true);
                    }
                });
                if ($('#competitorTable tbody tr').hasClass('selected')) {
                    $('#delCompetitor').prop('disabled', false);
                } else {
                    $('#delCompetitor').prop('disabled', true);
                }
                if($('#roundTable tbody tr.selected').length == 0){
                    $('.competitor').hide();
                }else {
                    $('.competitor').show();
                }
            });
        };
        function competitorAjax(){
            var roundParams = {
                id : round_id_selected
            };
            $.ajax({
                url: '/competitors',
                type: 'GET',
                dataType: 'json',
                data: roundParams,
                success: function(data) {
                    $('#competitorTable tbody').html("");
                    competitions = [];
                    $.each(data, function(index, competitor) {
                        var competition = {
                            name: competitor.name,
                            email: competitor.email
                        };

                        competitions.push(competition);
                        $('#competitorTable tbody').append(`
                            <tr>
                                <td>${competitor.name}</td>
                                <td>${competitor.email}</td>
                            </tr>
                        `);
                    });
                    userAjax();
                    competitorInitTable();
                },
                error: function() {
                    alert('Sikertelen volt az adatok betöltése.');
                }
            });
        }
        function competitorAjaxDel(){
            var competitorDelParams = {
                name : competitor_name_selected,
                email : competitor_email_selected,
                round_id : round_id_selected
            };
            $.ajax({
                url: '/competitorDel',
                type: 'DELETE',
                dataType: 'json',
                data: competitorDelParams,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    competitorAjax();
                },
                error: function() {
                    alert('Sikertelen volt az adat törlése');
                }
            });
        }
        function competitorAjaxAdd(){
            $selected = $('#competitiorUser').val().split('-');
            var competitorAddParams = {
                name : $selected[0],
                email : $selected[1],
                round_id : round_id_selected
            };
            $.ajax({
                url: '/competitorAdd',
                type: 'POST',
                dataType: 'json',
                data: competitorAddParams,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    competitorAjax();
                    userAjax();
                },
                error: function() {
                    alert('Sikertelen volt az adat hozzáadása');
                }
            });
        }
        function userAjax(){
            var competitionInUser;
            $.ajax({
                url: '/users',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var competitorUserOptions = "";
                    $.each(data, function(index, user) {
                        competitionInUser = 0;
                        $.each(competitions, function(index,competitionTmp){
                            if(competitionTmp.name == user.name && competitionTmp.email == user.email){
                                competitionInUser = 1;
                            }
                        });
                        if(competitionInUser == 0){
                            competitorUserOptions+= "<option value='"+user.name+"-"+user.email+"'>"+user.name+" - "+user.email+"</option>";
                            user_name_tmp = user.name;
                            user_email_tmp = user.email;
                        }
                    });

                    $('#competitiorUser').html(competitorUserOptions);
                },
                error: function() {
                    alert('Sikertelen volt az adatok betöltése');
                }
            });
        }

    </script>
</body>
</html>
