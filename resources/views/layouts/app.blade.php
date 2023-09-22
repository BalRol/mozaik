<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your App Name</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .selected {
          background-color: #f0f0f0; /* Kijelölt sor háttérszíne */
        }
      </style>
</head>
<body>
    <header>
    </header>

    <main>
        <h1>Competition List</h1>
            <table id="competitionTable">
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
        <div>
            <input type="text" id="competitionName" placeholder="Name">
            <input type="text" id="competitionYear" placeholder="Year">
            <input type="text" id="competitionLocation" placeholder="Location"><br>
            <button id="addCompetition">Add Competition</button>
            <button id="delCompetition">Delete Competition</button>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>

                $(document).ready(function() {

                    // Fetch data from the CompetitionController
                    $.ajax({
                        url: '/competitions', // Route to the getCompetition method
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // Loop through the data and append rows to the table
                            $.each(data, function(index, competition) {
                                $('#competitionTable tbody').append(`
                                    <tr>
                                        <td id="${competition.name.toLowerCase()}">${competition.name}</td>
                                        <td id="${competition.year.toLowerCase()}">${competition.year}</td>
                                        <td id="${competition.location.toLowerCase()}">${competition.location}</td>
                                    </tr>
                                `);
                            });
                            competitiorInitTable();
                        },
                        error: function() {
                            alert('Error fetching competition data.');
                        }
                    });
                });
                function competitiorInitTable() {
                    $(document).ready(function() {
                        $('#competitionTable tbody tr').click(function() {
                           // Kijelölt sor megjelölése
                           $(this).addClass('selected').siblings().removeClass('selected');
                           // Adatok kinyerése a kijelölt sorból
                           var competition_name_selected = $(this).find('td:eq(0)').text();
                           var competition_year_selected = $(this).find('td:eq(1)').text();
                           var competition_location_selected = $(this).find('td:eq(2)').text();
                        });
                    });
                };
            </script>
        <h1>Round List</h1>
            <table id="roundTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Date</th>
                        <th>Competition Name</th>
                        <th>Competition Year</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data rows will be inserted here dynamically -->
                </tbody>
            </table>
        <div>
            <input type="text" id="roundName" placeholder="Name">
            <input type="text" id="roundYear" placeholder="Location">
            <input type="text" id="roundLocation" placeholder="Date">
            <select id="roundCompetition" ></select>
            <button id="addRound">Add Competition</button>
            <button id="delRound">Delete Competition</button>
        </div>
            <script>
                $(document).ready(function() {
                    // Fetch data from the RoundController
                    $.ajax({
                        url: '/rounds', // Route to the index method in RoundController
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                        var options="";
                        var competition_name_tmp, competition_year_tmp;
                            // Loop through the data and append rows to the table
                            $.each(data, function(index, round) {
                                $('#roundTable tbody').append(`
                                    <tr>
                                        <td hidden>${round.id}</td>
                                        <td>${round.name}</td>
                                        <td>${round.location}</td>
                                        <td>${round.date}</td>
                                        <td>${round.competition_name}</td>
                                        <td>${round.competition_year}</td>
                                    </tr>
                                `);
                                if(!(round.competition_name == competition_name_tmp && round.competition_year == competition_year_tmp)){
                                    options+= "<option value='"+round.competition_name.toLowerCase()+""+round.competition_year.toLowerCase()+"'>"+round.competition_name+" - "+round.competition_year.toLowerCase()+"</option>";
                                    competition_year_tmp = round.competition_year;
                                    competition_name_tmp = round.competition_name;
                                }
                            });

                            $('#roundCompetition').html(options);
                            roundInitTable();
                        },
                        error: function() {
                            alert('Error fetching round data.');
                        }
                    });
                });
                function roundInitTable() {
                    $(document).ready(function() {
                        $('#roundTable tbody tr').click(function() {
                           // Kijelölt sor megjelölése
                           $(this).addClass('selected').siblings().removeClass('selected');
                           // Adatok kinyerése a kijelölt sorból
                           var round_id_selected = $(this).find('td:eq(0)').text();
                           var round_name_selected = $(this).find('td:eq(1)').text();
                           var round_location_selected = $(this).find('td:eq(2)').text();
                           var round_date_selected = $(this).find('td:eq(3)').text();
                           var round_competition_name_selected = $(this).find('td:eq(4)').text();
                           var round_competition_year_selected = $(this).find('td:eq(5)').text();
                        });
                    });
                };
            </script>
        <h1>Competitor List</h1>
            <table id="competitorTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data rows will be inserted here dynamically -->
                </tbody>
            </table>
            <div>
                <select id="competitiorUser" ></select>
                <button id="addCompetitor">Add Competitor</button>
                <button id="delCompetitor">Delete Competitor</button>
            </div>
            <script>
                $(document).ready(function() {
                    // Fetch data from the CompetitorController
                    $.ajax({
                        url: '/competitors', // Route to the index method in CompetitorController
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // Loop through the data and append rows to the table
                            var competitor_name_tmp, competitor_email_tmp, competitor_round_tmp;
                            var competitorUserOptions = "";
                            var competitorRoundOptions = "";
                            $.each(data, function(index, competitor) {
                                $('#competitorTable tbody').append(`
                                    <tr>
                                        <td>${competitor.name}</td>
                                        <td>${competitor.email}</td>
                                    </tr>
                                `);
                                if(!(competitor_name_tmp == competitor.name && competitor_email_tmp == competitor.email)){
                                    competitorUserOptions+= "<option value='"+competitor.name.toLowerCase()+""+competitor.email.toLowerCase()+"'>"+competitor.name+" - "+competitor.email+"</option>";
                                    competitor_name_tmp = competitor.name;
                                    competitor_email_tmp = competitor.email;
                                }
                            });

                            $('#competitiorUser').html(competitorUserOptions);
                            competitorInitTable();
                        },
                        error: function() {
                            alert('Error fetching competitor data.');
                        }
                    });
                    function competitorInitTable() {
                        $(document).ready(function() {
                            $('#competitorTable tbody tr').click(function() {
                               // Kijelölt sor megjelölése
                               $(this).addClass('selected').siblings().removeClass('selected');
                               // Adatok kinyerése a kijelölt sorból
                               var competitor_name_selected = $(this).find('td:eq(0)').text();
                               var competitor_email_selected = $(this).find('td:eq(1)').text();
                            });
                        });
                    };
                });
            </script>
    </main>

    <footer>
    </footer>
</body>
</html>
