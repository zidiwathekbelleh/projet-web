<?php ob_start(); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-calendar-alt me-2"></i>Gestion des événements
    </h1>
    <div class="d-flex gap-2">
        <a href="<?= BASE_URL ?>/event/exportPdf" class="btn btn-success">
            <i class="fas fa-file-pdf me-1"></i> PDF
        </a>
        <a href="<?= BASE_URL ?>/event/exportCsv" class="btn btn-info text-white">
            <i class="fas fa-file-csv me-1"></i> CSV
        </a>
        <a href="<?= BASE_URL ?>/event/create" class="btn btn-primary">
            <i class="fas fa-plus-circle me-1"></i> Ajouter
        </a>
    </div>
</div>

<!-- Messages d'alerte -->
<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $_SESSION['success']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $_SESSION['error']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Liste des événements</h6>
        <div class="d-flex gap-2">
            <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Rechercher..." style="width: 200px;">
            <select id="rowsPerPage" class="form-select form-select-sm" style="width: 80px;">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="eventsTable">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" class="sortable" data-sort="id">ID <i class="fas fa-sort"></i></th>
                        <th scope="col" class="sortable" data-sort="title">Titre <i class="fas fa-sort"></i></th>
                        <th scope="col" class="sortable" data-sort="start_date">Date début <i class="fas fa-sort"></i></th>
                        <th scope="col" class="sortable" data-sort="end_date">Date fin <i class="fas fa-sort"></i></th>
                        <th scope="col" class="sortable" data-sort="location">Lieu <i class="fas fa-sort"></i></th>
                        <th scope="col">Créateur</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($events) && is_array($events)): ?>
                    <?php foreach ($events as $e): ?>
                        <tr>
                            <td><span class="badge bg-secondary">#<?= $e['id'] ?></span></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="event-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="fas fa-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <strong><?= htmlspecialchars($e['title']) ?></strong>
                                        <?php if (!empty($e['description'])): ?>
                                            <br>
                                            <small class="text-muted"><?= mb_substr(htmlspecialchars($e['description']), 0, 50) ?>...</small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-nowrap">
                                    <i class="fas fa-play-circle text-success me-1"></i>
                                    <?= date('d/m/Y H:i', strtotime($e['start_date'])) ?>
                                </div>
                            </td>
                            <td>
                                <div class="text-nowrap">
                                    <i class="fas fa-stop-circle text-danger me-1"></i>
                                    <?= date('d/m/Y H:i', strtotime($e['end_date'])) ?>
                                </div>
                            </td>
                            <td>
                                <i class="fas fa-map-marker-alt text-warning me-1"></i>
                                <?= htmlspecialchars($e['location']) ?>
                            </td>
                            <td>
                                <?php if (!empty($e['creator_name'])): ?>
                                    <span class="badge bg-info"><?= htmlspecialchars($e['creator_name']) ?></span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Inconnu</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="<?= BASE_URL ?>/event/show/<?= $e['id'] ?>" class="btn btn-info btn-sm" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?= BASE_URL ?>/event/edit/<?= $e['id'] ?>" class="btn btn-warning btn-sm" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= BASE_URL ?>/event/delete/<?= $e['id'] ?>" class="btn btn-danger btn-sm" title="Supprimer"
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <div class="text-muted">
                                <i class="fas fa-calendar-times fa-2x mb-2"></i>
                                <p>Aucun événement trouvé</p>
                                <a href="<?= BASE_URL ?>/event/create" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus me-1"></i>Créer le premier événement
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center" id="pagination">
                <!-- La pagination sera générée par JavaScript -->
            </ul>
        </nav>
    </div>
</div>

<style>
.event-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}

.sortable {
    cursor: pointer;
    user-select: none;
}

.sortable:hover {
    background-color: #f8f9fa;
}

.table-responsive {
    min-height: 300px;
}

.btn-group .btn {
    margin: 0 2px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Configuration
    const table = document.getElementById('eventsTable');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    const searchInput = document.getElementById('searchInput');
    const rowsPerPageSelect = document.getElementById('rowsPerPage');
    const pagination = document.getElementById('pagination');
    
    let currentPage = 1;
    let rowsPerPage = parseInt(rowsPerPageSelect.value);
    let currentSort = { column: null, direction: 'asc' };

    // Fonction de recherche
    searchInput.addEventListener('input', function() {
        currentPage = 1;
        filterAndSortTable();
    });

    // Changement du nombre de lignes par page
    rowsPerPageSelect.addEventListener('change', function() {
        rowsPerPage = parseInt(this.value);
        currentPage = 1;
        filterAndSortTable();
    });

    // Tri des colonnes
    document.querySelectorAll('.sortable').forEach(header => {
        header.addEventListener('click', () => {
            const column = header.dataset.sort;
            if (currentSort.column === column) {
                currentSort.direction = currentSort.direction === 'asc' ? 'desc' : 'asc';
            } else {
                currentSort.column = column;
                currentSort.direction = 'asc';
            }
            filterAndSortTable();
        });
    });

    function filterAndSortTable() {
        const searchTerm = searchInput.value.toLowerCase();
        
        // Filtrer les lignes
        const filteredRows = rows.filter(row => {
            const cells = row.querySelectorAll('td');
            return Array.from(cells).some(cell => 
                cell.textContent.toLowerCase().includes(searchTerm)
            );
        });

        // Trier les lignes
        if (currentSort.column) {
            filteredRows.sort((a, b) => {
                const aValue = a.querySelector(`td:nth-child(${getColumnIndex(currentSort.column)})`).textContent;
                const bValue = b.querySelector(`td:nth-child(${getColumnIndex(currentSort.column)})`).textContent;
                
                let comparison = 0;
                if (aValue > bValue) comparison = 1;
                if (aValue < bValue) comparison = -1;
                
                return currentSort.direction === 'desc' ? -comparison : comparison;
            });
        }

        // Afficher la pagination
        displayPagination(filteredRows.length);
        
        // Afficher les lignes pour la page courante
        displayRows(filteredRows);
    }

    function getColumnIndex(columnName) {
        const headers = Array.from(table.querySelectorAll('th'));
        return headers.findIndex(header => header.dataset.sort === columnName) + 1;
    }

    function displayRows(rowsArray) {
        // Cacher toutes les lignes
        rows.forEach(row => row.style.display = 'none');
        
        // Afficher les lignes pour la page courante
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        
        rowsArray.slice(start, end).forEach(row => {
            row.style.display = '';
        });
    }

    function displayPagination(totalRows) {
        const totalPages = Math.ceil(totalRows / rowsPerPage);
        let html = '';
        
        if (totalPages > 1) {
            // Bouton précédent
            html += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                <a class="page-link" href="#" data-page="${currentPage - 1}">Précédent</a>
            </li>`;
            
            // Pages
            for (let i = 1; i <= totalPages; i++) {
                html += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link" href="#" data-page="${i}">${i}</a>
                </li>`;
            }
            
            // Bouton suivant
            html += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                <a class="page-link" href="#" data-page="${currentPage + 1}">Suivant</a>
            </li>`;
        }
        
        pagination.innerHTML = html;
        
        // Ajouter les écouteurs d'événements
        pagination.querySelectorAll('.page-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                currentPage = parseInt(this.dataset.page);
                filterAndSortTable();
            });
        });
    }

    // Initialiser le tableau
    filterAndSortTable();
});
</script>

<?php
$content = ob_get_clean();
require APP . '/views/admin/layout.php';