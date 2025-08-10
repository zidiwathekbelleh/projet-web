<?php
// app/views/admin/dashboard.php
ob_start();
?>
<div class="row g-4 mb-4">
  <div class="col-md-4">
    <div class="card text-white bg-primary p-3">
      <div class="card-body text-center">
        <h6>Utilisateurs</h6>
        <h2><?= $stats['total_users'] ?></h2>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card text-white bg-success p-3">
      <div class="card-body text-center">
        <h6>Événements</h6>
        <h2><?= $stats['total_events'] ?></h2>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card text-dark bg-warning p-3">
      <div class="card-body text-center">
        <h6>Participations</h6>
        <h2><?= $stats['total_participations'] ?></h2>
      </div>
    </div>
  </div>
</div>

<div class="row g-4">
  <div class="col-lg-4">
    <div class="card p-3">
      <h6 class="mb-3">Répartition des rôles</h6>
      <canvas id="rolesChart"></canvas>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card p-3">
      <h6 class="mb-3">Événements par mois</h6>
      <canvas id="eventsChart"></canvas>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card p-3">
      <h6 class="mb-3">Participations par statut</h6>
      <canvas id="statusChart"></canvas>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  new Chart(document.getElementById('rolesChart'), {
    type: 'doughnut',
    data: {
      labels: <?= json_encode(array_keys($stats['roles_distribution'] ?? [])) ?>,
      datasets: [{
        data: <?= json_encode(array_values($stats['roles_distribution'] ?? [])) ?>,
        backgroundColor: ['#0d6efd','#198754','#ffc107','#dc3545']
      }]
    },
    options: { responsive:true }
  });

  new Chart(document.getElementById('eventsChart'), {
    type: 'bar',
    data: {
      labels: <?= json_encode(array_keys($stats['events_per_month'] ?? [])) ?>,
      datasets: [{ label:'Événements', data: <?= json_encode(array_values($stats['events_per_month'] ?? [])) ?>, backgroundColor:'#198754' }]
    },
    options: { responsive:true }
  });

  new Chart(document.getElementById('statusChart'), {
    type: 'pie',
    data: {
      labels: <?= json_encode(array_keys($stats['participations_status'] ?? [])) ?>,
      datasets: [{ data: <?= json_encode(array_values($stats['participations_status'] ?? [])) ?>, backgroundColor:['#ffc107','#198754','#dc3545'] }]
    },
    options: { responsive:true }
  });
</script>

<?php
$content = ob_get_clean();
$title = 'Tableau de bord';
require APP . '/views/admin/layout.php';
