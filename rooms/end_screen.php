<?php
require_once('../dbcon.php');
session_start();

// Dit bestand toont het einde-scherm van de escape room.
// Het laat zien of het team heeft gewonnen of verloren.

// Preview voor testen
if (!isset($_SESSION['team_name']) || empty($_SESSION['team_name'])) {
    if (isset($_GET['preview']) && $_GET['preview'] === '1') {
        $_SESSION['team_name'] = 'TestTeam';
    } else {
        header("Location: ../index.php");
        exit;
    }
}

//dit zorgt dat alle output veilig in HTML kan worden weergegeven.
$teamName = htmlspecialchars($_SESSION['team_name']);

//bepaal of het einde een overwinning is of verlies.
$isWin = isset($_GET['result']) && $_GET['result'] === 'win';

//haal de eindtijd op uit de URL, of gebruik een standaardwaarde.
$completionTime = isset($_GET['time']) ? htmlspecialchars($_GET['time']) : '00:00';

//preview-modus mag zonder echte login worden bekeken.
$isPreview = isset($_GET['preview']) && $_GET['preview'] === '1';
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escape Room - Einde</title>
  <link href="https://fonts.googleapis.com/css2?family=Jersey+10&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/homepage.css">
  <link rel="stylesheet" href="../css/endscreen.css">
</head>
<body>

  <div class="end-screen" style="background-image: linear-gradient(rgba(7,9,29,0.75), rgba(7,9,29,0.75)), url('<?= $isWin ? '../img/space.png' : '../img/middeleeuwen.png' ?>');">

    <div class="content">
      <?php if ($isWin): ?>
        <h1 class="title win">🎉 GEWONNEN! 🎉</h1>
        <p class="subtitle">Jullie hebben het gehaald!</p>
        <div class="message">
          Jullie zijn op tijd ontsnapt uit de escape room.<br>
          Een ongelooflijke prestatie!
        </div>
      <?php else: ?>
        <h1 class="title loss">⏰ TIJD IS OP ⏰</h1>
        <p class="subtitle">Helaas...</p>
        <div class="message">
          Jullie hebben het niet gehaald binnen de tijd.<br>
          Maar geef niet op, probeer het nog een keer!
        </div>
      <?php endif; ?>

      <div class="team-info">
        Team: <strong><?= $teamName ?></strong>
      </div>

      <?php if ($isWin): ?>
        <div class="time">
          ⏱️ Eindtijd: <strong><?= $completionTime ?></strong>
        </div>
      <?php endif; ?>

      <div class="buttons">
        <button class="btn-home" onclick="window.location.href='../index.php'">
          🏠 Terug naar Home
        </button>
        <button class="btn-replay" onclick="window.location.href='room_1.php'">
          🔄 Opnieuw Spelen
        </button>
      </div>
    </div>
  </div>

</body>
</html>