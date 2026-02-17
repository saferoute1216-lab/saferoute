<?php include 'header.php'; ?>

<link rel="stylesheet" href="adminhome.css"> 
<link rel="stylesheet" href="evacdash.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="page">
    <div class="topbar">
        <h1>Evacuation Centers</h1>
    </div>

    <?php
    $surnames = ['Bautista', 'Garcia', 'Reyes', 'Dela Cruz', 'Santos', 'Mendoza', 'Pascual', 'Aquino', 'Villanueva', 'Lim'];
    $firstnames = ['Antonio', 'Maria', 'Juan', 'Elena', 'Ricardo', 'Gloria', 'Roberto', 'Liza', 'Fernando', 'Teresa'];
    $member_names = ['Mark', 'Joy', 'Rico', 'Ana', 'Jun', 'Elena', 'Bea', 'Paolo'];

    $centers = [
        ['id' => 'hall1', 'name' => 'Barangay Hall #1', 'icon' => 'fa-map-marker-alt', 'max' => 500, 'occ' => 320, 'avail' => 180],
        ['id' => 'gym', 'name' => 'School Gym', 'icon' => 'fa-dumbbell', 'max' => 300, 'occ' => 285, 'avail' => 15],
        ['id' => 'community', 'name' => 'Community Center', 'icon' => 'fa-users', 'max' => 400, 'occ' => 398, 'avail' => 2],
        ['id' => 'sports', 'name' => 'Sports Complex', 'icon' => 'fa-running', 'max' => 600, 'occ' => 324, 'avail' => 276]
    ];

    foreach ($centers as $center): ?>
        <div id="<?php echo $center['id']; ?>" class="panel full section-spacer">
            <div class="panel-head">
                <h2 style="color: #256055;"><i class="fas <?php echo $center['icon']; ?>"></i> <?php echo $center['name']; ?></h2>
            </div>

            <div class="stats-bar">
                <span>Max: <?php echo $center['max']; ?></span>
                <span>Occupants: <?php echo $center['occ']; ?></span>
                <span style="color: <?php echo ($center['avail'] < 10) ? 'red' : '#256055'; ?>;">Available: <?php echo $center['avail']; ?></span>
            </div>

            <table id="table-<?php echo $center['id']; ?>" style="width:100%; border-collapse: collapse;">
                <thead>
                    <tr style="text-align:left; border-bottom: 2px solid #eee;">
                        <th style="padding:10px;">Name / Family Head</th>
                        <th>Type</th>
                        <th>Goods</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    for ($i = 1; $i <= 40; $i++): 
                        $is_individual = ($i % 5 == 0);
                        $rand_name = $surnames[array_rand($surnames)] . ", " . $firstnames[array_rand($firstnames)];
                        $row_class = ($i > 20) ? 'hidden-row' : '';
                    ?>
                        <tr class="<?php echo $row_class; ?>" style="border-bottom: 1px solid #eee;">
                            <td style="padding:12px 10px;">
                                <?php if (!$is_individual): ?>
                                    <details>
                                        <summary><i class="fas fa-caret-right" style="color:#256055;"></i> <?php echo $rand_name; ?></summary>
                                        <div class="member-box">
                                            <ul style="list-style:none; padding:0; font-size:13px;">
                                                <li>• <?php echo $surnames[array_rand($surnames)] . ", " . $member_names[array_rand($member_names)]; ?> (Spouse)</li>
                                                <li>• <?php echo $surnames[array_rand($surnames)] . ", " . $member_names[array_rand($member_names)]; ?> (Child)</li>
                                            </ul>
                                        </div>
                                    </details>
                                <?php else: ?>
                                    <i class="fas fa-user" style="color:#ccc; margin-right:8px;"></i> <?php echo $rand_name; ?>
                                <?php endif; ?>
                            </td>
                            <td style="font-size:13px;"><?php echo $is_individual ? "Single" : "Family"; ?></td>
                            <td>
                                <span style="color: <?php echo ($i % 3 == 0) ? '#f97316' : '#16a34a'; ?>; font-size: 13px; font-weight:600;">
                                    <i class="fas <?php echo ($i % 3 == 0) ? 'fa-clock' : 'fa-check-circle'; ?>"></i>
                                    <?php echo ($i % 3 == 0) ? 'Pending' : 'Received'; ?>
                                </span>
                            </td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
            
            <button class="btn-load-more" onclick="loadMore('<?php echo $center['id']; ?>', this)">
                <i class="fas fa-plus"></i> Load Next 20
            </button>
        </div>
    <?php endforeach; ?>
</div>

<?php include 'footer.php'; ?>