<?php
// Start session to store tables data
session_start();

// Initialize tables array if not exists
if (!isset($_SESSION['tables'])) {
    $_SESSION['tables'] = [];
}

// Handle add table action
if (isset($_POST['action']) && $_POST['action'] === 'add') {
    $newTable = [
        'id' => uniqid(),
        'type' => 'reserver',
        'client' => '',
        'title' => 'Table ' . (count($_SESSION['tables']) + 1)
    ];
    $_SESSION['tables'][] = $newTable;
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Handle remove table action
if (isset($_POST['action']) && $_POST['action'] === 'remove' && isset($_POST['table_id'])) {
    foreach ($_SESSION['tables'] as $key => $table) {
        if ($table['id'] === $_POST['table_id']) {
            unset($_SESSION['tables'][$key]);
            $_SESSION['tables'] = array_values($_SESSION['tables']);
            break;
        }
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Handle update table action
if (isset($_POST['action']) && $_POST['action'] === 'update' && isset($_POST['table_id'])) {
    foreach ($_SESSION['tables'] as $key => $table) {
        if ($table['id'] === $_POST['table_id']) {
            $_SESSION['tables'][$key]['type'] = $_POST['type'];
            $_SESSION['tables'][$key]['client'] = $_POST['client'];
            $_SESSION['tables'][$key]['title'] = $_POST['title'];
            break;
        }
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resto Table Manager - Add & Remove Tables</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px 20px;
            min-height: 100vh;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header Section */
        .header {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .header h1 {
            color: #2c3e50;
            font-size: 32px;
            margin-bottom: 10px;
        }

        .header p {
            color: #666;
            margin-bottom: 20px;
        }

        .add-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .add-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }

        /* Tables Grid */
        .tables-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }

        /* Individual Table Card */
        .table-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            animation: fadeInUp 0.5s ease-out;
        }

        .table-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        /* Table Header */
        .table-header {
            background: linear-gradient(135deg, #2c3e50 0%, #1a2632 100%);
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h3 {
            font-size: 18px;
            font-weight: 600;
        }

        .remove-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .remove-btn:hover {
            background: #c0392b;
            transform: scale(1.05);
        }

        /* Table Content */
        .table-content {
            padding: 20px;
        }

        /* Status Display */
        .status-display {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 14px;
        }

        .status-reserver {
            background: #f39c12;
            color: white;
        }

        .status-holding {
            background: #27ae60;
            color: white;
        }

        .client-info {
            margin-top: 15px;
            padding: 10px;
            background: white;
            border-radius: 10px;
            border-left: 4px solid #667eea;
        }

        .client-info strong {
            color: #2c3e50;
        }

        .client-info p {
            color: #666;
            margin-top: 5px;
        }

        /* Form Section */
        .form-section {
            border-top: 1px solid #e0e0e0;
            padding-top: 20px;
        }

        .form-section h4 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 500;
            font-size: 13px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px 12px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .update-btn {
            background: #27ae60;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
        }

        .update-btn:hover {
            background: #229954;
            transform: translateY(-2px);
        }

        /* Empty state */
        .empty-state {
            background: white;
            border-radius: 20px;
            padding: 60px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .empty-state p {
            color: #999;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .empty-state small {
            color: #bbb;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .tables-grid {
                grid-template-columns: 1fr;
            }
            
            .header h1 {
                font-size: 24px;
            }
            
            .empty-state {
                padding: 40px 20px;
            }
        }

        /* Stats */
        .stats {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 10px 20px;
            display: inline-block;
            margin-top: 15px;
        }

        .stats span {
            font-weight: bold;
            color: #667eea;
            font-size: 20px;
        }

        /* Client select styling */
        select[name="client"] {
            background: white;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <h1>🍽️ Resto Table Manager</h1>
            <p>Manage restaurant tables - reserve or hold tables for clients</p>
            <form method="POST" style="display: inline;">
                <input type="hidden" name="action" value="add">
                <button type="submit" class="add-btn">➕ Add New Table</button>
            </form>
            <div class="stats">
                📊 Total Tables: <span><?php echo count($_SESSION['tables']); ?></span>
            </div>
        </div>

        <!-- Tables Grid -->
        <div class="tables-grid">
            <?php if (empty($_SESSION['tables'])): ?>
                <div class="empty-state">
                    <p>✨ No tables yet! Click "Add New Table" to get started.</p>
                    <small>Each table can be reserved or held for clients</small>
                </div>
            <?php else: ?>
                <?php foreach ($_SESSION['tables'] as $table): ?>
                    <div class="table-card">
                        <div class="table-header">
                            <h3><?php echo htmlspecialchars($table['title']); ?></h3>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="action" value="remove">
                                <input type="hidden" name="table_id" value="<?php echo $table['id']; ?>">
                                <button type="submit" class="remove-btn" onclick="return confirm('Are you sure you want to remove this table?')">🗑️ Remove</button>
                            </form>
                        </div>
                        
                        <div class="table-content">
                            <!-- Display Table Status -->
                            <div class="status-display">
                                <?php if ($table['type'] === 'reserver'): ?>
                                    <div class="status-badge status-reserver">🔔 Reserved</div>
                                <?php else: ?>
                                    <div class="status-badge status-holding">⏳ On Hold</div>
                                <?php endif; ?>
                                
                                <div class="client-info">
                                    <strong>👤 Client:</strong>
                                    <?php if (!empty($table['client'])): ?>
                                        <p><?php echo htmlspecialchars($table['client']); ?></p>
                                    <?php else: ?>
                                        <p style="color: #999;">No client assigned</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Edit Form -->
                            <div class="form-section">
                                <h4>✏️ Edit Table Information</h4>
                                <form method="POST">
                                    <input type="hidden" name="action" value="update">
                                    <input type="hidden" name="table_id" value="<?php echo $table['id']; ?>">
                                    
                                    <div class="form-group">
                                        <label>Table Name:</label>
                                        <input type="text" name="title" value="<?php echo htmlspecialchars($table['title']); ?>" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Status Type:</label>
                                        <select name="type">
                                            <option value="reserver" <?php echo $table['type'] == 'reserver' ? 'selected' : ''; ?>>🔔 Reserved</option>
                                            <option value="holding" <?php echo $table['type'] == 'holding' ? 'selected' : ''; ?>>⏳ On Hold</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Client Name:</label>
                                        <input type="text" name="client" value="<?php echo htmlspecialchars($table['client']); ?>" placeholder="Enter client name...">
                                    </div>
                                    
                                    <button type="submit" class="update-btn">💾 Update Table</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    
</body>
</html>