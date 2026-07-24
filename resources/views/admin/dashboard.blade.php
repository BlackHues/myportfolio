<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Expense Dashboard</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ @filemtime(public_path('css/app.css')) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --bg: #041C1A;
            --bg-2: #0B2F2B;
            --bg-3: #08332d;
            --green: #16E38A;
            --gold: #FFC94A;
            --white: #F8F8F8;
            --gray: #AAB5B1;
            --glass: rgba(255, 255, 255, 0.06);
            --glass-border: rgba(255, 255, 255, 0.12);
            --glow-green: 0 0 28px rgba(22, 227, 138, 0.28);
        }
        .panel {
            border: 1px solid var(--glass-border);
            background: rgba(8, 40, 36, 0.72);
            box-shadow: 0 16px 36px rgba(0, 0, 0, 0.28), inset 0 1px 0 rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            color: var(--white);
        }
        .soft-input {
            border: 1px solid var(--glass-border);
            background: rgba(0, 0, 0, 0.28);
            color: var(--white);
        }
        .soft-input::placeholder {
            color: rgba(170, 181, 177, 0.55);
        }
        .soft-input:focus {
            outline: none;
            border-color: rgba(22, 227, 138, 0.55);
            box-shadow: 0 0 0 3px rgba(22, 227, 138, 0.14);
            background: rgba(0, 0, 0, 0.38);
        }
        .primary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--green), #0fbf72);
            color: #04221e;
            font-weight: 700;
            border: 1px solid transparent;
            box-shadow: var(--glow-green);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .primary-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 0 36px rgba(22, 227, 138, 0.45);
        }
        .success-btn {
            background: linear-gradient(135deg, var(--green), #0fbf72);
            border-color: transparent;
            color: #04221e;
            box-shadow: var(--glow-green);
        }
        .action-icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 1.9rem;
            height: 1.9rem;
            border-radius: 0.5rem;
            border: 1px solid var(--glass-border);
            background: rgba(255, 255, 255, 0.06);
            color: var(--gray);
            transition: all 0.2s ease;
        }
        .action-icon-btn:hover {
            background: rgba(22, 227, 138, 0.12);
            color: var(--green);
            transform: translateY(-1px);
        }
        .action-icon-btn-danger {
            border-color: rgba(251, 113, 133, 0.35);
            color: #fb7185;
        }
        .action-icon-btn-danger:hover {
            background: rgba(251, 113, 133, 0.12);
        }
        .modal-backdrop {
            background: rgba(2, 16, 14, 0.62);
        }
        .app-modal {
            border: 1px solid var(--glass-border);
            border-radius: 1rem;
            background: linear-gradient(160deg, #0B2F2B 0%, #062420 100%);
            color: var(--white);
            box-shadow: 0 28px 60px rgba(0, 0, 0, 0.45), var(--glow-green);
            width: min(720px, 92vw);
            max-height: 88vh;
            overflow: auto;
            padding: 1.1rem;
        }
        .app-modal h3 {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            color: var(--white);
        }
        .app-modal form {
            gap: 0.75rem;
        }
        .app-modal input,
        .app-modal select,
        .app-modal textarea {
            background: rgba(0, 0, 0, 0.28);
            border: 1px solid var(--glass-border);
            color: var(--white);
        }
        .app-modal input::placeholder,
        .app-modal textarea::placeholder {
            color: rgba(170, 181, 177, 0.55);
        }
        .app-modal button[type="submit"] {
            grid-column: 1 / -1;
            width: 100%;
            justify-content: center;
        }
        .icon-chip {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            border-radius: 0.55rem;
            border: 1px solid rgba(22, 227, 138, 0.28);
            background: rgba(22, 227, 138, 0.12);
            color: var(--green);
        }
        .quick-card-btn {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            width: 100%;
            padding: 0.75rem;
            border-radius: 0.75rem;
            border: 1px solid var(--glass-border);
            background: rgba(255, 255, 255, 0.04);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            color: var(--white);
            text-align: left;
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        }
        .quick-card-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.28);
            border-color: rgba(22, 227, 138, 0.4);
        }
        .quick-card-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 1.9rem;
            height: 1.9rem;
            border-radius: 0.5rem;
            background: rgba(22, 227, 138, 0.12);
            color: var(--green);
            border: 1px solid rgba(22, 227, 138, 0.28);
            flex-shrink: 0;
        }
        .quick-card-title {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--white);
            line-height: 1.2rem;
        }
        dialog.app-modal {
            display: none;
            position: fixed;
            inset: 0;
            margin: auto;
            z-index: 60;
        }
        dialog.app-modal[open] {
            display: block;
        }
        dialog.app-modal::backdrop {
            background: rgba(2, 16, 14, 0.72);
        }
    </style>
</head>
<body class="admin-shell min-h-screen text-slate-100">
<style>
    .admin-shell {
        font-family: "Outfit", system-ui, sans-serif;
        background:
            radial-gradient(ellipse 70% 50% at 12% 8%, rgba(22, 227, 138, 0.14), transparent 55%),
            radial-gradient(ellipse 50% 40% at 88% 12%, rgba(255, 201, 74, 0.08), transparent 50%),
            linear-gradient(180deg, #041C1A 0%, #062420 45%, #041C1A 100%);
        color: var(--white);
        padding: 0.75rem;
        min-height: 100vh;
    }
    .admin-shell h1,
    .admin-shell h2,
    .admin-shell h3 {
        font-family: "Syne", "Outfit", sans-serif;
        letter-spacing: -0.02em;
        color: var(--white);
    }
    .admin-frame {
        width: 100%;
        margin: 0 auto;
        background: rgba(8, 36, 33, 0.55);
        border: 1px solid var(--glass-border);
        border-radius: 26px;
        box-shadow: 0 28px 50px rgba(0, 0, 0, 0.35), inset 0 1px 0 rgba(255, 255, 255, 0.05);
        display: grid;
        grid-template-columns: 78px 1fr;
        min-height: calc(100vh - 3.5rem);
        overflow: hidden;
        backdrop-filter: blur(10px);
    }
    .admin-sidebar {
        background: rgba(6, 28, 25, 0.85);
        border-right: 1px solid var(--glass-border);
        padding: 1.1rem 0.8rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.9rem;
    }
    .admin-side-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        border: 1px solid var(--glass-border);
        background: rgba(255, 255, 255, 0.05);
        color: var(--gray);
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    button.admin-side-icon {
        cursor: pointer;
        transition: all 0.2s ease;
    }
    button.admin-side-icon:hover {
        border-color: rgba(22, 227, 138, 0.45);
        color: var(--green);
        transform: translateY(-1px);
        box-shadow: 0 0 18px rgba(22, 227, 138, 0.18);
    }
    .admin-side-icon.active {
        background: rgba(22, 227, 138, 0.16);
        color: var(--green);
        border-color: rgba(22, 227, 138, 0.4);
        box-shadow: var(--glow-green);
    }
    .admin-main {
        padding: 1.6rem;
        min-width: 0;
    }
    .admin-topbar,
    .panel,
    .hero-card,
    .history-table-wrap {
        min-width: 0;
    }
    .admin-topbar {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid var(--glass-border);
        border-radius: 18px;
        padding: 1rem 1.1rem;
        backdrop-filter: blur(12px);
    }
    .hero-card {
        border-radius: 16px;
        background: linear-gradient(145deg, #0B2F2B 0%, #0a3d34 45%, #08332d 100%);
        color: #ffffff;
        border: 1px solid rgba(22, 227, 138, 0.28);
        box-shadow: 0 16px 32px rgba(0, 0, 0, 0.35), var(--glow-green);
    }
    .finance-card {
        border-radius: 14px;
        padding: 0.9rem 1rem;
        border: 1px solid rgba(15, 23, 42, 0.08);
        box-shadow: 0 10px 20px rgba(15, 23, 42, 0.08);
        position: relative;
        overflow: hidden;
    }
    .finance-card::after {
        content: '';
        position: absolute;
        inset: auto -10% -45% auto;
        width: 170px;
        height: 170px;
        border-radius: 999px;
        opacity: 0.14;
        background: #ffffff;
        pointer-events: none;
    }
    .credit-visual {
        background: linear-gradient(140deg, #f0cb66 0%, #e9bd50 100%);
        color: #1f2937;
    }
    .debit-visual {
        background: linear-gradient(140deg, #7cc3ff 0%, #5999ff 100%);
        color: #ffffff;
    }
    .card-actions {
        margin-top: 0.75rem;
        display: flex;
        gap: 0.45rem;
        position: relative;
        z-index: 20;
    }
    .card-editable {
        cursor: pointer;
    }
    .routine-card {
        border-radius: 16px;
        border: 1px solid rgba(22, 227, 138, 0.22);
        background: linear-gradient(160deg, rgba(11, 47, 43, 0.9) 0%, rgba(8, 40, 36, 0.85) 100%);
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25);
    }
    .routine-date-nav {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 0.45rem;
    }
    .routine-date-chip {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--green);
        padding: 0.35rem 0.65rem;
        border-radius: 999px;
        background: rgba(22, 227, 138, 0.1);
        border: 1px solid rgba(22, 227, 138, 0.28);
    }
    .routine-progress {
        height: 0.45rem;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.1);
        overflow: hidden;
    }
    .routine-progress-bar {
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(90deg, var(--green), #0fbf72);
        transition: width 0.25s ease;
        box-shadow: 0 0 12px rgba(22, 227, 138, 0.35);
    }
    .routine-timeline {
        display: flex;
        flex-direction: column;
        gap: 0.55rem;
    }
    .routine-item {
        display: grid;
        grid-template-columns: minmax(7.5rem, auto) 1fr auto;
        gap: 0.65rem;
        align-items: start;
        padding: 0.75rem 0.85rem;
        border-radius: 0.85rem;
        border: 1px solid var(--glass-border);
        background: rgba(255, 255, 255, 0.04);
    }
    .routine-item.is-done {
        background: rgba(22, 227, 138, 0.08);
        border-color: rgba(22, 227, 138, 0.35);
    }
    .routine-time {
        min-width: 7.5rem;
        padding: 0.35rem 0.45rem;
        border-radius: 0.65rem;
        background: rgba(0, 0, 0, 0.22);
        border: 1px solid var(--glass-border);
    }
    .routine-time-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.35rem;
        font-size: 0.72rem;
        line-height: 1.35;
    }
    .routine-time-row + .routine-time-row {
        margin-top: 0.25rem;
    }
    .routine-time-value {
        font-weight: 700;
        color: var(--white);
        font-variant-numeric: tabular-nums;
    }
    .routine-item.is-done .routine-time-value {
        color: var(--green);
    }
    .routine-duration {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 0.4rem;
        padding: 0.2rem 0.45rem;
        border-radius: 999px;
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.02em;
        color: var(--gold);
        background: rgba(255, 201, 74, 0.12);
        border: 1px solid rgba(255, 201, 74, 0.28);
        text-align: center;
    }
    .routine-item.is-done .routine-duration {
        color: var(--green);
        background: rgba(22, 227, 138, 0.12);
        border-color: rgba(22, 227, 138, 0.3);
    }
    .routine-time-label {
        display: block;
        font-size: 0.58rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--gray);
        margin-bottom: 0.15rem;
    }
    .routine-duration-preview {
        font-size: 0.78rem;
        font-weight: 700;
        color: var(--gold);
        padding: 0.45rem 0.65rem;
        border-radius: 0.55rem;
        background: rgba(255, 201, 74, 0.12);
        border: 1px solid rgba(255, 201, 74, 0.28);
    }
    .routine-block-form {
        padding: 0.75rem;
        border-radius: 0.75rem;
        border: 1px dashed rgba(22, 227, 138, 0.28);
        background: rgba(0, 0, 0, 0.2);
    }
    .work-report-card {
        border-radius: 16px;
        border: 1px solid rgba(22, 227, 138, 0.28);
        background: linear-gradient(160deg, rgba(11, 47, 43, 0.95) 0%, rgba(5, 30, 26, 0.92) 100%);
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.28), var(--glow-green);
    }
    .work-report-type-btn {
        border: 1px solid var(--glass-border);
        background: rgba(255, 255, 255, 0.04);
        color: var(--gray);
        border-radius: 999px;
        padding: 0.4rem 0.85rem;
        font-size: 0.75rem;
        font-weight: 700;
        cursor: pointer;
    }
    .work-report-type-btn.is-active {
        border-color: rgba(22, 227, 138, 0.45);
        background: rgba(22, 227, 138, 0.14);
        color: var(--green);
    }
    .work-report-task-row {
        display: grid;
        grid-template-columns: auto 1fr auto;
        gap: 0.45rem;
        align-items: center;
    }
    .work-report-task-num {
        width: 1.85rem;
        height: 1.85rem;
        border-radius: 0.55rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.78rem;
        font-weight: 700;
        color: var(--green);
        background: rgba(22, 227, 138, 0.12);
        border: 1px solid rgba(22, 227, 138, 0.32);
        box-shadow: inset 0 0 12px rgba(22, 227, 138, 0.08);
        flex-shrink: 0;
    }
    .work-report-task-num[data-bullet-style="report"] {
        color: var(--gold);
        background: rgba(255, 201, 74, 0.12);
        border-color: rgba(255, 201, 74, 0.35);
        box-shadow: inset 0 0 12px rgba(255, 201, 74, 0.08);
        border-radius: 999px;
        font-size: 0.55rem;
    }
    .work-report-task-num i {
        line-height: 1;
    }
    .work-history-item {
        background: rgba(255, 255, 255, 0.04);
        border-color: var(--glass-border) !important;
        color: var(--white);
        transition: border-color 0.2s ease, transform 0.2s ease;
    }
    .work-history-item:hover {
        border-color: rgba(22, 227, 138, 0.45) !important;
        transform: translateY(-1px);
    }
    .work-history-item.is-active {
        border-color: rgba(22, 227, 138, 0.55) !important;
        box-shadow: 0 0 0 1px rgba(22, 227, 138, 0.25);
    }
    .work-report-preview {
        white-space: pre-wrap;
        font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
        font-size: 0.82rem;
        line-height: 1.55;
        background: rgba(0, 0, 0, 0.35);
        color: #e7f8ec;
        border-radius: 0.85rem;
        padding: 1rem;
        min-height: 180px;
        border: 1px solid rgba(22, 227, 138, 0.28);
    }
    .routine-title {
        font-size: 0.88rem;
        font-weight: 600;
        color: var(--white);
    }
    .routine-item.is-done .routine-title {
        color: var(--green);
        text-decoration: line-through;
    }
    .routine-details {
        font-size: 0.76rem;
        color: var(--gray);
        margin-top: 0.2rem;
        white-space: pre-wrap;
    }
    .routine-item-actions {
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }
    .routine-check-btn {
        width: 1.85rem;
        height: 1.85rem;
        border-radius: 999px;
        border: 1px solid var(--glass-border);
        background: rgba(255, 255, 255, 0.06);
        color: var(--gray);
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .routine-check-btn.is-done {
        border-color: rgba(22, 227, 138, 0.45);
        background: rgba(22, 227, 138, 0.16);
        color: var(--green);
    }
    .card-action-btn {
        border: 1px solid rgba(255, 255, 255, 0.22);
        background: rgba(255, 255, 255, 0.14);
        color: #0f172a;
        border-radius: 0.5rem;
        font-size: 0.75rem;
        padding: 0.22rem 0.45rem;
        font-weight: 600;
        min-width: 1.8rem;
        min-height: 1.8rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .card-action-btn-danger {
        border-color: rgba(251, 113, 133, 0.45);
        color: #9f1239;
        background: rgba(255, 241, 242, 0.9);
    }
    .todo-item {
        border: 1px solid var(--glass-border);
        border-left-width: 4px;
        border-left-style: solid;
        background: rgba(255, 255, 255, 0.04);
        color: var(--white);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.18);
        backdrop-filter: blur(6px);
    }
    .todo-item.dragging {
        opacity: 0.55;
    }
    .todo-item[data-draggable="true"] {
        cursor: grab;
    }
    .todo-item[data-draggable="true"]:active {
        cursor: grabbing;
    }
    .todo-priority-overdue {
        border-left-color: #fb7185;
        background: rgba(251, 113, 133, 0.1);
    }
    .todo-priority-today {
        border-left-color: #fb923c;
        background: rgba(251, 146, 60, 0.1);
    }
    .todo-priority-upcoming {
        border-left-color: var(--green);
        background: rgba(22, 227, 138, 0.08);
    }
    .todo-priority-soon {
        border-left-color: var(--gold);
        background: rgba(255, 201, 74, 0.1);
    }
    .todo-priority-mid {
        border-left-color: #38bdf8;
        background: rgba(56, 189, 248, 0.08);
    }
    .todo-priority-far {
        border-left-color: #2dd4bf;
        background: rgba(45, 212, 191, 0.08);
    }
    .todo-priority-none {
        border-left-color: rgba(255, 255, 255, 0.22);
    }
    .todo-priority-chip {
        display: inline-flex;
        align-items: center;
        border-radius: 999px;
        font-size: 0.67rem;
        font-weight: 600;
        padding: 0.12rem 0.5rem;
        border: 1px solid transparent;
    }
    .todo-chip-overdue {
        background: rgba(251, 113, 133, 0.16);
        color: #fda4af;
        border-color: rgba(251, 113, 133, 0.35);
    }
    .todo-chip-today {
        background: rgba(251, 146, 60, 0.16);
        color: #fdba74;
        border-color: rgba(251, 146, 60, 0.35);
    }
    .todo-chip-upcoming {
        background: rgba(22, 227, 138, 0.14);
        color: var(--green);
        border-color: rgba(22, 227, 138, 0.32);
    }
    .todo-chip-soon {
        background: rgba(255, 201, 74, 0.14);
        color: var(--gold);
        border-color: rgba(255, 201, 74, 0.32);
    }
    .todo-chip-mid {
        background: rgba(56, 189, 248, 0.14);
        color: #7dd3fc;
        border-color: rgba(56, 189, 248, 0.32);
    }
    .todo-chip-far {
        background: rgba(45, 212, 191, 0.14);
        color: #5eead4;
        border-color: rgba(45, 212, 191, 0.32);
    }
    .todo-chip-none {
        background: rgba(255, 255, 255, 0.06);
        color: var(--gray);
        border-color: var(--glass-border);
    }
    .todo-chip-completed {
        background: rgba(22, 227, 138, 0.16);
        color: var(--green);
        border-color: rgba(22, 227, 138, 0.35);
    }
    .todo-chip-dropped {
        background: rgba(251, 113, 133, 0.16);
        color: #fda4af;
        border-color: rgba(251, 113, 133, 0.35);
    }
    .todo-chip-incomplete {
        background: rgba(255, 255, 255, 0.08);
        color: var(--gray);
        border-color: var(--glass-border);
    }
    .todo-meta-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        font-size: 0.67rem;
        font-weight: 600;
        border-radius: 999px;
        padding: 0.15rem 0.5rem;
        background: rgba(255, 255, 255, 0.08);
        color: var(--gray);
    }
    .todo-action-btn {
        font-size: 0.72rem;
        font-weight: 600;
        border-radius: 0.45rem;
        border: 1px solid var(--glass-border);
        background: rgba(255, 255, 255, 0.06);
        color: var(--gray);
        padding: 0.2rem 0.45rem;
        min-width: 1.7rem;
        min-height: 1.7rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .todo-action-btn-danger {
        border-color: rgba(251, 113, 133, 0.35);
        color: #fb7185;
    }
    .todo-pin-btn {
        width: 1.7rem;
        height: 1.7rem;
        border-radius: 999px;
        border: 1px solid var(--glass-border);
        background: rgba(255, 255, 255, 0.06);
        color: var(--gray);
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .todo-pin-btn.is-pinned {
        border-color: rgba(255, 201, 74, 0.45);
        background: rgba(255, 201, 74, 0.16);
        color: var(--gold);
    }
    .todo-filter-wrap {
        position: relative;
    }
    .todo-filter-toggle {
        width: 2.1rem;
        height: 2.1rem;
        border-radius: 999px;
        border: 1px solid var(--glass-border);
        background: rgba(255, 255, 255, 0.06);
        color: var(--gray);
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .todo-filter-menu {
        position: absolute;
        top: 2.4rem;
        right: 0;
        width: 13.5rem;
        z-index: 20;
        border: 1px solid var(--glass-border);
        border-radius: 0.75rem;
        background: linear-gradient(160deg, #0B2F2B 0%, #062420 100%);
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.4);
        padding: 0.65rem;
        display: none;
    }
    .todo-filter-menu.open {
        display: block;
    }
    .todo-filter-label {
        font-size: 0.66rem;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--gray);
        margin-bottom: 0.25rem;
        display: block;
    }
    .todo-filter-select {
        width: 100%;
        border: 1px solid var(--glass-border);
        background: rgba(0, 0, 0, 0.28);
        border-radius: 0.5rem;
        padding: 0.4rem 0.55rem;
        font-size: 0.78rem;
        color: var(--white);
    }
    .todo-premium-card {
        background: linear-gradient(160deg, rgba(11, 47, 43, 0.92) 0%, rgba(8, 40, 36, 0.88) 100%);
        border: 1px solid rgba(22, 227, 138, 0.22);
        box-shadow: 0 18px 34px rgba(0, 0, 0, 0.28);
    }
    .todo-section-title {
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        font-weight: 700;
        color: var(--gray);
        margin-top: 0.95rem;
        margin-bottom: 0.45rem;
    }
    .todo-status-icon-btn {
        width: 1.7rem;
        height: 1.7rem;
        border-radius: 999px;
        border: 1px solid var(--glass-border);
        background: rgba(255, 255, 255, 0.06);
        color: var(--gray);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.18s ease;
    }
    .todo-status-icon-btn:hover {
        transform: translateY(-1px);
    }
    .todo-status-icon-btn.status-incomplete:hover {
        border-color: rgba(255, 255, 255, 0.28);
        color: var(--white);
    }
    .todo-status-icon-btn.status-completed:hover {
        border-color: rgba(22, 227, 138, 0.45);
        background: rgba(22, 227, 138, 0.14);
        color: var(--green);
    }
    .todo-status-icon-btn.status-dropped:hover {
        border-color: rgba(251, 113, 133, 0.45);
        background: rgba(251, 113, 133, 0.12);
        color: #fb7185;
    }
    .history-table-wrap {
        border: 1px solid var(--glass-border);
        border-radius: 0.9rem;
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
        background: rgba(0, 0, 0, 0.18);
    }
    .history-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 0.85rem;
    }
    .history-table thead th {
        background: rgba(22, 227, 138, 0.08);
        color: var(--gray);
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        font-weight: 700;
        padding: 0.72rem 0.75rem;
        border-bottom: 1px solid var(--glass-border);
        text-align: left;
        white-space: nowrap;
    }
    .history-table tbody td {
        padding: 0.72rem 0.75rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        vertical-align: top;
        text-align: left;
        color: var(--white);
    }
    .history-table thead th:not(:last-child),
    .history-table tbody td:not(:last-child) {
        border-right: 1px solid rgba(255, 255, 255, 0.06);
    }
    .history-table tbody tr:hover {
        background: rgba(22, 227, 138, 0.06);
    }
    .history-table tbody tr:last-child td {
        border-bottom: 0;
    }
    .history-note-cell {
        min-width: 220px;
        max-width: 320px;
        color: var(--gray);
        white-space: normal;
        line-height: 1.35;
    }
    .history-action-cell {
        white-space: nowrap;
    }
    @media (max-width: 1200px) {
        .admin-frame {
            grid-template-columns: 1fr;
        }
        .admin-sidebar {
            flex-direction: row;
            justify-content: center;
            border-right: 0;
            border-bottom: 1px solid var(--glass-border);
        }
        body {
            font-size: 14px;
        }
        .text-sm {
            font-size: 0.78rem !important;
            line-height: 1.1rem;
        }
        .text-xs {
            font-size: 0.66rem !important;
            line-height: 0.95rem;
        }
    }
    @media (max-width: 768px) {
        .admin-shell {
            padding: 0.4rem;
        }
        body {
            font-size: 13px;
        }
        .admin-frame {
            border-radius: 16px;
            min-height: calc(100vh - 1rem);
        }
        .admin-sidebar {
            justify-content: flex-start;
            overflow-x: auto;
            padding: 0.7rem 0.6rem;
            gap: 0.6rem;
        }
        .admin-side-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            flex: 0 0 auto;
        }
        .admin-main {
            padding: 0.9rem;
        }
        .admin-topbar {
            border-radius: 14px;
            padding: 0.85rem;
        }
        .admin-topbar h1 {
            font-size: 0.98rem;
            line-height: 1.25rem;
        }
        h2.text-lg {
            font-size: 0.9rem;
            line-height: 1.15rem;
        }
        .text-sm {
            font-size: 0.72rem !important;
            line-height: 1rem;
        }
        .text-xs {
            font-size: 0.62rem !important;
            line-height: 0.9rem;
        }
        .history-table {
            font-size: 0.7rem;
        }
        .todo-section-title {
            font-size: 0.62rem;
        }
        .history-note-cell {
            min-width: 170px;
            max-width: 240px;
        }
        .history-table thead th,
        .history-table tbody td {
            padding: 0.58rem 0.6rem;
            font-size: 0.78rem;
        }
        .todo-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.6rem;
        }
        .todo-item .ml-6 {
            margin-left: 0;
        }
        .todo-premium-card {
            display: block !important;
            width: 100%;
        }
        #todoList,
        #todoCompletedList {
            min-height: 1.75rem;
        }
    }
    @media (max-width: 640px) {
        body {
            font-size: 12px;
        }
        .admin-topbar h1 {
            font-size: 0.9rem;
            line-height: 1.15rem;
        }
        h2.text-lg {
            font-size: 0.82rem;
            line-height: 1.05rem;
        }
        .text-sm {
            font-size: 0.67rem !important;
            line-height: 0.95rem;
        }
        .text-xs {
            font-size: 0.58rem !important;
            line-height: 0.82rem;
        }
        .admin-action-group {
            width: 100%;
            flex-direction: column;
            align-items: stretch;
        }
        .admin-action-group > * {
            width: 100%;
        }
        .expense-toolbar,
        .expense-filter-form {
            width: 100%;
        }
        .expense-toolbar .soft-input,
        .expense-toolbar .primary-btn,
        .expense-filter-form .soft-input,
        .expense-filter-form .primary-btn {
            width: 100%;
        }
        .hero-card .w-40 {
            width: 8rem;
            height: 8rem;
        }
        .history-table-wrap {
            border-radius: 0.7rem;
        }
    }
    .weight-progress-chart-wrap {
        height: 240px;
    }
    .weight-total-card {
        min-height: 240px;
    }
    .weight-calorie-chart-wrap {
        height: 240px;
    }
    .expense-pie-wrap {
        width: min(100%, 29rem);
        height: min(100%, 29rem);
        border-radius: 999px;
        background: rgba(22, 227, 138, 0.08);
        padding: 0.25rem;
        box-shadow: 0 24px 30px rgba(0, 0, 0, 0.35), 0 0 28px rgba(22, 227, 138, 0.12);
        border: 1px solid rgba(22, 227, 138, 0.22);
    }
    .expense-pie-wrap canvas {
        width: 100% !important;
        height: 100% !important;
    }
    .pie-legend-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.5rem;
        padding-bottom: 0.55rem;
        margin-bottom: 0.55rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.22);
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.82);
    }
    .pie-legend-total {
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0;
        text-transform: none;
        color: #ffffff;
    }
    .pie-legend-list {
        display: flex;
        flex-direction: column;
        gap: 0.45rem;
        max-height: none;
    }
    .pie-legend-item {
        display: grid;
        grid-template-columns: auto 1fr auto;
        align-items: center;
        gap: 0.45rem 0.55rem;
        padding: 0.35rem 0.45rem;
        border-radius: 0.55rem;
        background: rgba(255, 255, 255, 0.08);
    }
    .pie-legend-item-main {
        display: flex;
        align-items: center;
        gap: 0.45rem;
        min-width: 0;
    }
    .pie-legend-dot {
        flex-shrink: 0;
        width: 0.65rem;
        height: 0.65rem;
        border-radius: 999px;
        box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.35);
    }
    .pie-legend-name {
        font-size: 0.78rem;
        font-weight: 600;
        color: #ffffff;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .pie-legend-bar-wrap {
        grid-column: 2 / -1;
        height: 0.28rem;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.14);
        overflow: hidden;
    }
    .pie-legend-bar {
        display: block;
        height: 100%;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.92);
    }
    .pie-legend-stats {
        font-size: 0.72rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.92);
        white-space: nowrap;
        text-align: right;
    }
    .side-showcase-card {
        border-radius: 0.95rem;
        overflow: hidden;
        border: 1px solid var(--glass-border);
        background: rgba(255, 255, 255, 0.04);
        box-shadow: 0 14px 26px rgba(0, 0, 0, 0.28);
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }
    .side-showcase-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 18px 30px rgba(0, 0, 0, 0.35), 0 0 24px rgba(22, 227, 138, 0.12);
        border-color: rgba(22, 227, 138, 0.4);
    }
    .side-showcase-card.is-active {
        border-color: rgba(22, 227, 138, 0.55);
        box-shadow: 0 0 0 2px rgba(22, 227, 138, 0.28), 0 14px 26px rgba(0, 0, 0, 0.3);
    }
    .side-showcase-image {
        width: 100%;
        height: 165px;
        object-fit: cover;
        display: block;
        filter: saturate(0.9) brightness(0.88);
    }
    .side-showcase-body {
        padding: 0.65rem 0.8rem 0.75rem;
        background: rgba(4, 28, 26, 0.72);
    }
    .side-showcase-title {
        font-size: 0.78rem;
        font-weight: 700;
        color: var(--white);
    }
    .side-showcase-subtitle {
        font-size: 0.68rem;
        color: var(--gray);
        margin-top: 0.2rem;
    }
    .side-showcase-work-hero {
        width: 100%;
        height: 165px;
        display: grid;
        place-items: center;
        background: linear-gradient(145deg, #052e1c 0%, #0B2F2B 45%, #08332d 100%);
        color: var(--green);
        font-size: 3rem;
    }
    .side-showcase-card-work.is-active .side-showcase-work-hero {
        color: #86efac;
        box-shadow: inset 0 0 40px rgba(22, 227, 138, 0.15);
    }
    .dashboard-content-panel {
        display: none;
    }
    .dashboard-content-panel.is-visible {
        display: block;
    }
    @media (max-width: 640px) {
        .expense-pie-wrap {
            width: min(100%, 20rem);
            height: min(100%, 20rem);
            padding: 0.2rem;
        }
        .weight-progress-chart-wrap {
            height: 210px;
        }
        .weight-total-card {
            min-height: 150px;
        }
        .weight-calorie-chart-wrap {
            height: 210px;
        }
    }

    /* Portfolio theme: neutralize light Tailwind utilities inside admin shell */
    .admin-shell .bg-white,
    .admin-shell .bg-slate-50,
    .admin-shell .bg-slate-100,
    .admin-shell .bg-white\/80 {
        background-color: rgba(255, 255, 255, 0.04) !important;
    }
    .admin-shell .bg-emerald-50 {
        background-color: rgba(22, 227, 138, 0.12) !important;
    }
    .admin-shell .bg-rose-50 {
        background-color: rgba(251, 113, 133, 0.12) !important;
    }
    .admin-shell .from-indigo-50,
    .admin-shell .via-sky-50,
    .admin-shell .to-cyan-50,
    .admin-shell .from-indigo-100,
    .admin-shell .from-cyan-50,
    .admin-shell .from-emerald-50,
    .admin-shell .from-amber-50,
    .admin-shell .via-orange-50,
    .admin-shell .to-rose-50,
    .admin-shell .to-blue-50 {
        --tw-gradient-from: rgba(22, 227, 138, 0.12) !important;
        --tw-gradient-to: rgba(8, 51, 45, 0.55) !important;
        --tw-gradient-stops: var(--tw-gradient-from), rgba(11, 47, 43, 0.65), var(--tw-gradient-to) !important;
    }
    .admin-shell .to-sky-100 {
        --tw-gradient-to: rgba(8, 51, 45, 0.9) !important;
    }
    .admin-shell .border-slate-200,
    .admin-shell .border-slate-300,
    .admin-shell .border-emerald-100,
    .admin-shell .border-indigo-200,
    .admin-shell .border-indigo-100,
    .admin-shell .border-cyan-100,
    .admin-shell .border-cyan-200,
    .admin-shell .border-teal-100,
    .admin-shell .border-amber-100 {
        border-color: var(--glass-border) !important;
    }
    .admin-shell .text-cyan-700,
    .admin-shell .text-indigo-700,
    .admin-shell .text-indigo-800,
    .admin-shell .text-sky-700 {
        color: var(--green) !important;
    }
    .admin-shell .text-rose-700,
    .admin-shell .text-rose-800 {
        color: #fda4af !important;
    }
    .admin-shell .text-slate-900,
    .admin-shell .text-slate-800,
    .admin-shell .text-slate-700 {
        color: var(--white) !important;
    }
    .admin-shell .text-slate-600,
    .admin-shell .text-slate-500,
    .admin-shell .text-slate-400 {
        color: var(--gray) !important;
    }
    .admin-shell .text-emerald-800,
    .admin-shell .text-emerald-700 {
        color: var(--green) !important;
    }
    .admin-shell .primary-btn.bg-white {
        background: linear-gradient(135deg, var(--green), #0fbf72) !important;
        color: #04221e !important;
    }
    .admin-shell select,
    .admin-shell input[type="text"],
    .admin-shell input[type="number"],
    .admin-shell input[type="date"],
    .admin-shell input[type="time"],
    .admin-shell input[type="month"],
    .admin-shell textarea {
        color-scheme: dark;
    }
    .admin-shell .soft-input option,
    .admin-shell select option {
        background: #0B2F2B;
        color: var(--white);
    }
    .admin-sidebar {
        border-bottom-color: var(--glass-border);
    }
</style>
<div class="admin-frame">
    <aside class="admin-sidebar">
        <button type="button" class="admin-side-icon open-modal" data-modal="expenseCreateModal" title="Add Expense">
            <i class="fa-solid fa-wallet"></i>
        </button>
        <button type="button" class="admin-side-icon open-modal" data-modal="incomeCreateModal" title="Add Income">
            <i class="fa-solid fa-money-bill-trend-up"></i>
        </button>
        <button type="button" class="admin-side-icon open-modal" data-modal="creditCardCreateModal" title="Add Credit Card">
            <i class="fa-solid fa-credit-card"></i>
        </button>
        <button type="button" class="admin-side-icon open-modal" data-modal="debitCardCreateModal" title="Add Debit Card">
            <i class="fa-solid fa-building-columns"></i>
        </button>
        <button type="button" class="admin-side-icon open-modal" data-modal="cashBalanceEditModal" title="Edit cash in hand">
            <i class="fa-solid fa-money-bill-wave"></i>
        </button>
        <button type="button" class="admin-side-icon open-modal" data-modal="stockCreateModal" title="Add Stock">
            <i class="fa-solid fa-chart-column"></i>
        </button>
        <button type="button" class="admin-side-icon open-modal" data-modal="savingsAdjustmentCreateModal" title="Add Savings Adjustment">
            <i class="fa-solid fa-scale-balanced"></i>
        </button>
        <button type="button" class="admin-side-icon open-modal" data-modal="categoryCreateModal" title="Add Category">
            <i class="fa-solid fa-tags"></i>
        </button>
        <button type="button" class="admin-side-icon open-modal" data-modal="weightLogCreateModal" title="Add Weight Entry">
            <i class="fa-solid fa-weight-scale"></i>
        </button>
    </aside>
<div class="admin-main">
    <div class="admin-topbar mb-6">
    <div class="flex flex-wrap items-center justify-between gap-3">
        <div>
            <h1 class="text-2xl font-semibold">Admin Expense Dashboard</h1>
            <p class="text-sm text-slate-600 mt-1">One page view for your todo list, wallet, and expense pie chart.</p>
        </div>
        <div class="admin-action-group flex items-center gap-2">
            <a href="{{ route('admin.visitors.index') }}" class="primary-btn px-4 py-2 text-sm font-medium">
                <i class="fa-solid fa-chart-line text-xs"></i>
                Visitor Logs
            </a>
            <form action="{{ route('admin.logout') }}" method="post">
                @csrf
                <button type="submit" class="primary-btn px-4 py-2 text-sm font-medium">
                    <i class="fa-solid fa-right-from-bracket text-xs"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>
    </div>

    @if (session('status'))
        <div class="mt-4 rounded-lg bg-emerald-50 px-3 py-2 text-sm text-emerald-800">{{ session('status') }}</div>
    @endif
    @if ($errors->any())
        <div class="mt-4 rounded-lg bg-rose-50 px-3 py-2 text-sm text-rose-800">{{ $errors->first() }}</div>
    @endif

    <div class="grid xl:grid-cols-4 gap-6 mt-6">
        <section class="lg:col-span-1 rounded-xl bg-white p-5 panel todo-premium-card dashboard-content-panel" data-dashboard-panel="goal">
            <h2 class="text-lg font-semibold">Todo List</h2>
            <p class="text-sm text-slate-500 mt-1">Local checklist for your daily tasks.</p>
            <form id="todoForm" class="mt-4 grid grid-cols-1 gap-2 sm:grid-cols-[1fr_auto_auto]">
                <input id="todoInput" type="text" placeholder="Add a task..." class="soft-input rounded-lg px-3 py-2 text-sm" required>
                <input id="todoDueDate" type="date" class="soft-input rounded-lg px-3 py-2 text-sm">
                <button type="submit" class="primary-btn px-4 py-2 text-sm font-medium">
                    <i class="fa-solid fa-plus text-[11px]"></i>
                    Add
                </button>
            </form>
            <div class="mt-3 flex items-center justify-between gap-2">
                <p class="text-[11px] text-slate-500">Pin tasks, drag to reorder (manual sort), and filter from the icon.</p>
                <div class="todo-filter-wrap">
                    <button type="button" id="todoFilterToggle" class="todo-filter-toggle" title="Sort & Filter">
                        <i class="fa-solid fa-sliders text-xs"></i>
                    </button>
                    <div id="todoFilterMenu" class="todo-filter-menu">
                        <label class="todo-filter-label" for="todoFilterBy">Filter</label>
                        <select id="todoFilterBy" class="todo-filter-select">
                            <option value="all">All tasks</option>
                            <option value="incomplete">Incomplete only</option>
                            <option value="completed">Completed only</option>
                            <option value="dropped">Dropped only</option>
                            <option value="pinned">Pinned only</option>
                            <option value="overdue">Overdue</option>
                            <option value="today">Due today</option>
                            <option value="week">Due in 1 week</option>
                            <option value="next14">Due in 8-14 days</option>
                            <option value="later">Due in 15+ days</option>
                            <option value="no_date">No due date</option>
                        </select>
                        <label class="todo-filter-label mt-2" for="todoSortBy">Sort by</label>
                        <select id="todoSortBy" class="todo-filter-select">
                            <option value="manual">Manual (drag)</option>
                            <option value="due_date">Due date</option>
                            <option value="created">Created time</option>
                        </select>
                        <label class="todo-filter-label mt-2" for="todoSortOrder">Order</label>
                        <select id="todoSortOrder" class="todo-filter-select">
                            <option value="asc">Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                    </div>
                </div>
            </div>
            <p class="todo-section-title">Active Tasks</p>
            <ul id="todoList" class="mt-4 space-y-2"></ul>
            <p class="todo-section-title">Completed / Dropped</p>
            <ul id="todoCompletedList" class="space-y-2"></ul>
        </section>

        <section class="xl:col-span-3 rounded-xl bg-white p-5 panel dashboard-content-panel" data-dashboard-panel="money">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h2 class="text-lg font-semibold">Expenses</h2>
                    <p class="text-sm text-slate-500">Filter by week, month, or year and track category spending.</p>
                </div>
                <div class="expense-toolbar flex flex-wrap items-center gap-2">
                    <form method="get" action="{{ route('admin.dashboard') }}" class="expense-filter-form flex flex-wrap items-center gap-2">
                        <select name="period" id="expensePeriodFilter" class="soft-input rounded-lg px-3 py-2 text-sm">
                            <option value="week" @selected($period === 'week')>Week</option>
                            <option value="month" @selected($period === 'month')>Month</option>
                            <option value="year" @selected($period === 'year')>Year</option>
                        </select>
                        <select name="month" id="expenseMonthFilter" data-filter-month class="soft-input rounded-lg px-3 py-2 text-sm">
                            @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $monthIndex => $monthLabel)
                                <option value="{{ $monthIndex + 1 }}" @selected($selectedMonth === ($monthIndex + 1))>{{ $monthLabel }}</option>
                            @endforeach
                        </select>
                        <select name="year" id="expenseYearFilter" data-filter-year class="soft-input rounded-lg px-3 py-2 text-sm">
                            @for ($yearOption = now()->year + 1; $yearOption >= now()->year - 10; $yearOption--)
                                <option value="{{ $yearOption }}" @selected($selectedYear === $yearOption)>{{ $yearOption }}</option>
                            @endfor
                        </select>
                        <button class="primary-btn px-4 py-2 text-sm">Apply</button>
                    </form>
                    <a href="{{ route('admin.expenses.export.csv', ['period' => $period, 'year' => $selectedYear, 'month' => $selectedMonth]) }}" class="primary-btn px-3 py-2 text-xs">
                        <i class="fa-solid fa-file-csv text-xs"></i> CSV
                    </a>
                    <a href="{{ route('admin.expenses.export.excel', ['period' => $period, 'year' => $selectedYear, 'month' => $selectedMonth]) }}" class="primary-btn px-3 py-2 text-xs">
                        <i class="fa-solid fa-file-excel text-xs"></i> Excel
                    </a>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6 mt-5">
                <div class="rounded-lg bg-slate-50 border border-slate-200 p-4">
                    <p class="text-xs uppercase text-slate-500">Selected Range</p>
                    <p class="font-medium mt-1">{{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }}</p>
                    <p class="text-xs uppercase text-slate-500 mt-3">Expense (direct)</p>
                    <p class="text-2xl font-semibold mt-1">Rs {{ number_format($totalExpense, 2) }}</p>
                    <p class="text-xs uppercase text-slate-500 mt-3">EMI excluded from expense</p>
                    <p class="text-base font-semibold mt-1 text-amber-700">Rs {{ number_format($totalEmiExpense, 2) }}</p>
                    <p class="text-xs uppercase text-slate-500 mt-3">Credit used (counts as expense)</p>
                    <p class="text-base font-semibold mt-1 text-rose-700">Rs {{ number_format($totalCreditUsed, 2) }} / {{ number_format($totalCreditLimit, 2) }}</p>
                    <p class="text-xs uppercase text-slate-500 mt-3">Effective Expense</p>
                    <p class="text-lg font-semibold mt-1 text-rose-700">Rs {{ number_format($effectiveExpense, 2) }}</p>
                    <p class="text-xs uppercase text-slate-500 mt-3">Total Income</p>
                    <p class="text-xl font-semibold mt-1 text-emerald-700">Rs {{ number_format($totalIncome, 2) }}</p>
                    <p class="text-xs uppercase text-slate-500 mt-3">Bank savings balance</p>
                    <p class="text-base font-semibold mt-1 text-indigo-700">Rs {{ number_format($totalDebitBalance, 2) }}</p>
                    <div class="mt-3 flex flex-wrap items-center justify-between gap-2">
                        <p class="text-xs uppercase text-slate-500">Cash in hand balance</p>
                        <button type="button" class="card-action-btn open-modal" data-modal="cashBalanceEditModal" title="Edit" aria-label="Edit">
                            <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                        </button>
                    </div>
                    <p class="text-base font-semibold mt-1 text-indigo-700">Rs {{ number_format($totalCashInHand, 2) }}</p>
                    <p class="text-[11px] text-slate-500 mt-1">Updates when you add income or expense as cash; use Edit to set or reconcile the balance.</p>
                    <p class="text-xs uppercase text-slate-500 mt-3">Savings adjustment</p>
                    <p class="text-base font-semibold mt-1 {{ $totalSavingsAdjustment >= 0 ? 'text-emerald-700' : 'text-rose-700' }}">
                        Rs {{ number_format($totalSavingsAdjustment, 2) }}
                    </p>
                    <p class="text-xs uppercase text-slate-500 mt-3">Savings (bank + cash - credit used + adjustments)</p>
                    <p class="text-lg font-semibold mt-1 {{ $savings >= 0 ? 'text-emerald-700' : 'text-rose-700' }}">
                        Rs {{ number_format($savings, 2) }}
                    </p>
                </div>
                <div class="hero-card p-4">
                    <div class="expense-pie-wrap mx-auto">
                        <canvas id="pieChart" class="w-full h-full"></canvas>
                    </div>
                    <div id="pieLegend" class="pie-legend-list mt-4 w-full pr-1"></div>
                </div>
            </div>
            <div class="mt-5 rounded-xl border border-cyan-100 bg-gradient-to-br from-slate-900 via-indigo-950 to-sky-950 p-4 shadow-lg">
                <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-cyan-200">Hologram Flow</p>
                        <p class="text-sm text-cyan-100">Day to day income vs expense ({{ ucfirst($period) }})</p>
                    </div>
                </div>
                <div class="h-[260px]">
                    <canvas id="dailyFlowHologramChart"></canvas>
                </div>
            </div>

        </section>
    </div>

    <section class="rounded-xl bg-white p-5 mt-6 panel">
        <div class="flex items-center justify-between gap-3 mb-3">
            <h2 class="text-lg font-semibold">Focus Sections</h2>
            <p class="text-xs text-slate-500">Click a card to open only that category.</p>
        </div>
        <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-4">
            <article class="side-showcase-card" role="button" tabindex="0" data-open-dashboard-panel="money">
                <img src="{{ asset('images/dashboard/finance-growth.png') }}" alt="Finance growth savings" class="side-showcase-image">
                <div class="side-showcase-body">
                    <p class="side-showcase-title">Money Management</p>
                    <p class="side-showcase-subtitle">Expenses, income, cards, stock and cash flow.</p>
                </div>
            </article>
            <article class="side-showcase-card" role="button" tabindex="0" data-open-dashboard-panel="fitness">
                <img src="{{ asset('images/dashboard/fitness-focus.png') }}" alt="Gym focus and workout" class="side-showcase-image">
                <div class="side-showcase-body">
                    <p class="side-showcase-title">Fitness</p>
                    <p class="side-showcase-subtitle">Weight trend, daily calories and log history.</p>
                </div>
            </article>
            <article class="side-showcase-card" role="button" tabindex="0" data-open-dashboard-panel="goal">
                <img src="{{ asset('images/dashboard/target-goal.png') }}" alt="Goal target concept" class="side-showcase-image">
                <div class="side-showcase-body">
                    <p class="side-showcase-title">Todo In Goal</p>
                    <p class="side-showcase-subtitle">Todos, daily routine notes, and net worth goals.</p>
                </div>
            </article>
            <article class="side-showcase-card side-showcase-card-work" role="button" tabindex="0" data-open-dashboard-panel="work">
                <div class="side-showcase-work-hero" aria-hidden="true">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
                <div class="side-showcase-body">
                    <p class="side-showcase-title">Office Work Report</p>
                    <p class="side-showcase-subtitle">Daily work plan / report templates for WhatsApp.</p>
                </div>
            </article>
        </div>
    </section>

    <section class="rounded-xl bg-white p-5 mt-6 panel dashboard-content-panel work-report-card" data-dashboard-panel="work">
        <div class="flex flex-wrap items-start justify-between gap-3">
            <div>
                <h2 class="text-lg font-semibold">Office Work Report</h2>
                <p class="text-sm text-slate-500 mt-1">Save daily plan/report anytime. Build weekly and monthly summaries from saved days. WhatsApp: <span class="font-semibold text-emerald-700">8606012194</span>.</p>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <button type="button" class="work-report-type-btn is-active" data-work-report-type="plan">Today's Work Plan</button>
                <button type="button" class="work-report-type-btn" data-work-report-type="report">Today's Work Report</button>
            </div>
        </div>

        <div class="mt-4 grid lg:grid-cols-2 gap-4">
            <div class="rounded-xl border border-emerald-100 bg-white p-4">
                <div class="grid sm:grid-cols-2 gap-2 mb-3">
                    <label class="block">
                        <span class="routine-time-label">Date</span>
                        <input type="date" id="workReportDate" value="{{ $workDate ?? now()->toDateString() }}" class="soft-input rounded-lg px-3 py-2 text-sm w-full">
                    </label>
                    <label class="block">
                        <span class="routine-time-label">Name</span>
                        <input type="text" id="workReportName" value="{{ old('employee_name', optional($workPlanEntry ?? $workReportEntry)->employee_name ?: 'Arjun Kumar H') }}" class="soft-input rounded-lg px-3 py-2 text-sm w-full">
                    </label>
                </div>

                <p class="routine-time-label" id="workReportTasksLabel">Plan tasks</p>
                <div id="workReportTaskList" class="space-y-2 mb-3"></div>
                <div class="flex flex-wrap gap-2">
                    <button type="button" id="workReportAddTask" class="primary-btn px-3 py-2 text-xs">
                        <i class="fa-solid fa-plus text-[10px]"></i> <span id="workReportAddTaskLabel">Add task</span>
                    </button>
                    <button type="button" id="workReportSave" class="primary-btn success-btn px-3 py-2 text-xs">
                        <i class="fa-solid fa-floppy-disk text-[10px]"></i> <span id="workReportSaveLabel">Save plan</span>
                    </button>
                    <button type="button" id="workReportLoadSample" class="card-action-btn px-3 py-2 text-xs" title="Load sample">
                        Load sample
                    </button>
                    <button type="button" id="workReportClearTasks" class="card-action-btn card-action-btn-danger px-3 py-2 text-xs" title="Clear tasks">
                        Clear
                    </button>
                </div>
                <p class="text-[11px] text-slate-500 mt-2" id="workReportHint">
                    Write morning plan with →. Switch to Report to auto-convert into completed ● lines; add extra tasks if any. Save to keep forever.
                </p>
                <p id="workReportSaveStatus" class="text-[11px] text-emerald-700 mt-2 hidden"></p>
            </div>

            <div class="rounded-xl border border-emerald-100 bg-white p-4">
                <div class="flex items-center justify-between gap-2 mb-2">
                    <p class="routine-time-label !mb-0">WhatsApp preview</p>
                    <span class="text-[11px] text-slate-500">→ plan · ● report</span>
                </div>
                <pre id="workReportPreview" class="work-report-preview" aria-live="polite"></pre>
                <div class="mt-3 flex flex-wrap gap-2">
                    <button type="button" id="workReportCopy" class="primary-btn px-4 py-2 text-sm">
                        <i class="fa-regular fa-copy text-xs"></i> Copy message
                    </button>
                    <a id="workReportWhatsApp" href="#" target="_blank" rel="noopener noreferrer" class="primary-btn success-btn px-4 py-2 text-sm inline-flex items-center gap-2">
                        <i class="fa-brands fa-whatsapp"></i> Send to office WhatsApp
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-4 grid lg:grid-cols-3 gap-4">
            <div class="rounded-xl border border-emerald-100 bg-white p-4">
                <div class="flex items-center justify-between gap-2 mb-2">
                    <p class="routine-time-label !mb-0">Saved history</p>
                    <span class="text-[11px] text-slate-500">Tap to load</span>
                </div>
                <div id="workReportHistoryList" class="space-y-2 max-h-72 overflow-auto pr-1">
                    @forelse (($workReportHistory ?? collect()) as $entry)
                        <button
                            type="button"
                            class="work-history-item w-full text-left rounded-lg border border-slate-200 px-3 py-2"
                            data-work-history-id="{{ $entry->id }}"
                            data-work-history-date="{{ optional($entry->report_date)->toDateString() }}"
                            data-work-history-type="{{ $entry->entry_type }}"
                            data-work-history-name="{{ $entry->employee_name }}"
                            data-work-history-tasks='@json($entry->tasks ?? [])'
                            data-work-history-extras='@json($entry->extra_tasks ?? [])'
                        >
                            <div class="flex items-center justify-between gap-2">
                                <span class="text-xs font-semibold">{{ optional($entry->report_date)->format('d/m/Y') }}</span>
                                <span class="text-[10px] uppercase tracking-wide {{ $entry->entry_type === 'report' ? 'text-amber-300' : 'text-emerald-700' }}">{{ $entry->entry_type }}</span>
                            </div>
                            <p class="text-[11px] text-slate-500 mt-1 truncate">
                                {{ collect(array_merge($entry->tasks ?? [], $entry->extra_tasks ?? []))->filter()->take(2)->implode(' · ') ?: 'Empty entry' }}
                            </p>
                        </button>
                    @empty
                        <p class="text-xs text-slate-500">No saved plans/reports yet. Save today’s plan to start history.</p>
                    @endforelse
                </div>
            </div>

            <div class="rounded-xl border border-emerald-100 bg-white p-4">
                <p class="routine-time-label !mb-2">Weekly report</p>
                <form method="get" action="{{ route('admin.dashboard') }}" class="grid grid-cols-[1fr_auto] gap-2 mb-3">
                    <input type="hidden" name="period" value="{{ $period }}">
                    <input type="hidden" name="year" value="{{ $selectedYear }}">
                    <input type="hidden" name="month" value="{{ $selectedMonth }}">
                    <input type="hidden" name="work_date" id="workWeekFormDate" value="{{ $workDate ?? now()->toDateString() }}">
                    <input type="hidden" name="work_month" value="{{ $workMonth ?? now()->month }}">
                    <input type="hidden" name="work_year" value="{{ $workYear ?? now()->year }}">
                    <label class="block">
                        <span class="routine-time-label">Week starting (Mon)</span>
                        <input type="date" name="work_week_start" value="{{ $workWeekStart ?? now()->startOfWeek(\Carbon\Carbon::MONDAY)->toDateString() }}" class="soft-input rounded-lg px-3 py-2 text-sm w-full">
                    </label>
                    <button type="submit" class="primary-btn px-3 py-2 text-xs self-end">Show</button>
                </form>
                <p class="text-[11px] text-slate-500 mb-2">
                    {{ $weeklyWorkSummary['period_label'] ?? '' }} · {{ $weeklyWorkSummary['days_logged'] ?? 0 }} days · {{ $weeklyWorkSummary['tasks_completed'] ?? 0 }} tasks
                </p>
                <pre id="workWeeklyPreview" class="work-report-preview min-h-[10rem]">{{ $weeklyWorkSummary['message'] ?? '' }}</pre>
                <div class="mt-3 flex flex-wrap gap-2">
                    <button type="button" class="primary-btn px-3 py-2 text-xs" data-copy-target="workWeeklyPreview">
                        <i class="fa-regular fa-copy text-[10px]"></i> Copy week
                    </button>
                    <a id="workWeeklyWhatsApp" href="https://wa.me/918606012194?text={{ urlencode($weeklyWorkSummary['message'] ?? '') }}" target="_blank" rel="noopener noreferrer" class="primary-btn success-btn px-3 py-2 text-xs inline-flex items-center gap-1">
                        <i class="fa-brands fa-whatsapp"></i> WhatsApp
                    </a>
                </div>
            </div>

            <div class="rounded-xl border border-emerald-100 bg-white p-4">
                <p class="routine-time-label !mb-2">Monthly report</p>
                <form method="get" action="{{ route('admin.dashboard') }}" class="grid grid-cols-2 gap-2 mb-3">
                    <input type="hidden" name="period" value="{{ $period }}">
                    <input type="hidden" name="year" value="{{ $selectedYear }}">
                    <input type="hidden" name="month" value="{{ $selectedMonth }}">
                    <input type="hidden" name="work_date" id="workMonthFormDate" value="{{ $workDate ?? now()->toDateString() }}">
                    <input type="hidden" name="work_week_start" value="{{ $workWeekStart ?? now()->startOfWeek(\Carbon\Carbon::MONDAY)->toDateString() }}">
                    <label class="block">
                        <span class="routine-time-label">Month</span>
                        <select name="work_month" class="soft-input rounded-lg px-3 py-2 text-sm w-full">
                            @for ($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}" @selected((int) ($workMonth ?? now()->month) === $m)>{{ \Carbon\Carbon::createFromDate(2020, $m, 1)->format('F') }}</option>
                            @endfor
                        </select>
                    </label>
                    <label class="block">
                        <span class="routine-time-label">Year</span>
                        <select name="work_year" class="soft-input rounded-lg px-3 py-2 text-sm w-full">
                            @for ($y = now()->year; $y >= now()->year - 4; $y--)
                                <option value="{{ $y }}" @selected((int) ($workYear ?? now()->year) === $y)>{{ $y }}</option>
                            @endfor
                        </select>
                    </label>
                    <button type="submit" class="primary-btn px-3 py-2 text-xs col-span-2">Generate monthly report</button>
                </form>
                <p class="text-[11px] text-slate-500 mb-2">
                    {{ $monthlyWorkSummary['period_label'] ?? '' }} · {{ $monthlyWorkSummary['days_logged'] ?? 0 }} days · {{ $monthlyWorkSummary['tasks_completed'] ?? 0 }} tasks
                </p>
                <pre id="workMonthlyPreview" class="work-report-preview min-h-[10rem]">{{ $monthlyWorkSummary['message'] ?? '' }}</pre>
                <div class="mt-3 flex flex-wrap gap-2">
                    <button type="button" class="primary-btn px-3 py-2 text-xs" data-copy-target="workMonthlyPreview">
                        <i class="fa-regular fa-copy text-[10px]"></i> Copy month
                    </button>
                    <a id="workMonthlyWhatsApp" href="https://wa.me/918606012194?text={{ urlencode($monthlyWorkSummary['message'] ?? '') }}" target="_blank" rel="noopener noreferrer" class="primary-btn success-btn px-3 py-2 text-xs inline-flex items-center gap-1">
                        <i class="fa-brands fa-whatsapp"></i> WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="rounded-xl bg-white p-5 mt-6 panel dashboard-content-panel routine-card" data-dashboard-panel="goal">
        <div class="flex flex-wrap items-start justify-between gap-3">
            <div>
                <h2 class="text-lg font-semibold">24-Hour Daily Routine & Notes</h2>
                <p class="text-sm text-slate-500 mt-1">Plan your full day (00:00–24:00). Time out can be after midnight — e.g. 20:00 to 01:00 counts as 5 hours overnight.</p>
            </div>
            <form method="get" action="{{ route('admin.dashboard') }}" class="routine-date-nav">
                <input type="hidden" name="period" value="{{ $period }}">
                <input type="hidden" name="year" value="{{ $selectedYear }}">
                <input type="hidden" name="month" value="{{ $selectedMonth }}">
                @php($prevRoutineDate = \Carbon\Carbon::parse($routineDate)->subDay()->toDateString())
                @php($nextRoutineDate = \Carbon\Carbon::parse($routineDate)->addDay()->toDateString())
                <a href="{{ route('admin.dashboard', ['period' => $period, 'year' => $selectedYear, 'month' => $selectedMonth, 'routine_date' => $prevRoutineDate]) }}" class="card-action-btn" title="Previous day" aria-label="Previous day">
                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                </a>
                <input type="date" name="routine_date" value="{{ $routineDate }}" class="soft-input rounded-lg px-3 py-2 text-sm">
                <button type="submit" class="primary-btn px-3 py-2 text-xs">Go</button>
                <a href="{{ route('admin.dashboard', ['period' => $period, 'year' => $selectedYear, 'month' => $selectedMonth, 'routine_date' => now()->toDateString()]) }}" class="routine-date-chip">Today</a>
                <a href="{{ route('admin.dashboard', ['period' => $period, 'year' => $selectedYear, 'month' => $selectedMonth, 'routine_date' => $nextRoutineDate]) }}" class="card-action-btn" title="Next day" aria-label="Next day">
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </a>
            </form>
        </div>

        <div class="mt-4 grid lg:grid-cols-2 gap-4">
            <div class="rounded-xl border border-slate-200 bg-white p-4">
                <div class="flex items-center justify-between gap-2 mb-2">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Day notes</p>
                    <span class="text-xs text-slate-500">{{ \Carbon\Carbon::parse($routineDate)->format('l, d M Y') }}</span>
                </div>
                <form method="post" action="{{ route('admin.daily-notes.upsert') }}">
                    @csrf
                    @method('put')
                    <input type="hidden" name="note_date" value="{{ $routineDate }}">
                    <input type="hidden" name="period" value="{{ $period }}">
                    <input type="hidden" name="year" value="{{ $selectedYear }}">
                    <input type="hidden" name="month" value="{{ $selectedMonth }}">
                    <textarea name="journal" rows="7" placeholder="Today's focus, priorities, reminders, or reflection..." class="soft-input rounded-lg px-3 py-2 text-sm w-full">{{ old('journal', $dailyNote?->journal) }}</textarea>
                    <button type="submit" class="primary-btn px-4 py-2 text-sm mt-2">Save notes</button>
                </form>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-4">
                <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Time blocks</p>
                    <span class="text-xs font-semibold text-indigo-700">{{ $routineDoneCount }}/{{ $routineTotalCount }} done</span>
                </div>
                @php($routineProgress = $routineTotalCount > 0 ? round(($routineDoneCount / $routineTotalCount) * 100) : 0)
                <div class="routine-progress mb-3">
                    <span class="routine-progress-bar" style="width: {{ $routineProgress }}%"></span>
                </div>
                @if ($errors->has('scheduled_time') || $errors->has('end_time') || $errors->has('title'))
                    <div class="rounded-lg bg-rose-50 px-3 py-2 text-sm text-rose-800 mb-3">
                        {{ $errors->first('scheduled_time') ?: ($errors->first('end_time') ?: $errors->first('title')) }}
                    </div>
                @endif
                <form method="post" action="{{ route('admin.routine-items.store') }}" class="routine-block-form grid grid-cols-1 sm:grid-cols-2 gap-2 mb-4">
                    @csrf
                    <input type="hidden" name="routine_date" value="{{ $routineDate }}">
                    <input type="hidden" name="period" value="{{ $period }}">
                    <input type="hidden" name="year" value="{{ $selectedYear }}">
                    <input type="hidden" name="month" value="{{ $selectedMonth }}">
                    <label class="block">
                        <span class="routine-time-label">Time in</span>
                        <input type="time" name="scheduled_time" value="{{ old('scheduled_time', '09:00') }}" required class="soft-input rounded-lg px-3 py-2 text-sm w-full">
                    </label>
                    <label class="block">
                        <span class="routine-time-label">Time out</span>
                        <input type="time" name="end_time" value="{{ old('end_time', '10:00') }}" required class="soft-input rounded-lg px-3 py-2 text-sm w-full">
                        <span class="text-[10px] text-slate-500 mt-1 block">Can be next day (after 00:00)</span>
                    </label>
                    <p class="routine-duration-preview sm:col-span-2">Duration: 1h</p>
                    <label class="block sm:col-span-2">
                        <span class="routine-time-label">Task</span>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="Deep work, Gym, Email..." required class="soft-input rounded-lg px-3 py-2 text-sm w-full">
                    </label>
                    <label class="block sm:col-span-2">
                        <span class="routine-time-label">Notes (optional)</span>
                        <input type="text" name="details" value="{{ old('details') }}" placeholder="Extra details for this block" class="soft-input rounded-lg px-3 py-2 text-sm w-full">
                    </label>
                    <div class="sm:col-span-2">
                        <button type="submit" class="primary-btn px-4 py-2 text-sm w-full sm:w-auto">Add time block</button>
                    </div>
                </form>

                <div class="routine-timeline">
                    @forelse ($routineItems as $item)
                        <article class="routine-item {{ $item->is_done ? 'is-done' : '' }}">
                            <div class="routine-time">
                                <div class="routine-time-row">
                                    <span class="routine-time-label !mb-0">Time in</span>
                                    <span class="routine-time-value">{{ $item->startTimeLabel() }}</span>
                                </div>
                                <div class="routine-time-row">
                                    <span class="routine-time-label !mb-0">Time out</span>
                                    <span class="routine-time-value">
                                        {{ $item->endTimeLabel() }}
                                        @if ($item->spansMidnight())
                                            <span class="text-[10px] font-semibold text-indigo-600">+1 day</span>
                                        @endif
                                    </span>
                                </div>
                                <span class="routine-duration">Duration · {{ $item->durationLabelWithOvernightHint() }}</span>
                            </div>
                            <div>
                                <p class="routine-title">{{ $item->title }}</p>
                                @if ($item->details)
                                    <p class="routine-details">{{ $item->details }}</p>
                                @endif
                            </div>
                            <div class="routine-item-actions">
                                <form method="post" action="{{ route('admin.routine-items.toggle', $item) }}">
                                    @csrf
                                    @method('patch')
                                    <input type="hidden" name="routine_date" value="{{ $routineDate }}">
                                    <input type="hidden" name="period" value="{{ $period }}">
                                    <input type="hidden" name="year" value="{{ $selectedYear }}">
                                    <input type="hidden" name="month" value="{{ $selectedMonth }}">
                                    <button type="submit" class="routine-check-btn {{ $item->is_done ? 'is-done' : '' }}" title="{{ $item->is_done ? 'Mark incomplete' : 'Mark done' }}" aria-label="{{ $item->is_done ? 'Mark incomplete' : 'Mark done' }}">
                                        <i class="fa-solid {{ $item->is_done ? 'fa-check' : 'fa-circle' }} text-[10px]"></i>
                                    </button>
                                </form>
                                <button type="button" class="card-action-btn open-modal" data-modal="routineEditModal{{ $item->id }}" title="Edit" aria-label="Edit">
                                    <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                                </button>
                                <form method="post" action="{{ route('admin.routine-items.delete', $item) }}">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="routine_date" value="{{ $routineDate }}">
                                    <input type="hidden" name="period" value="{{ $period }}">
                                    <input type="hidden" name="year" value="{{ $selectedYear }}">
                                    <input type="hidden" name="month" value="{{ $selectedMonth }}">
                                    <button type="submit" class="card-action-btn card-action-btn-danger" title="Delete" aria-label="Delete">
                                        <i class="fa-solid fa-trash text-[10px]"></i>
                                    </button>
                                </form>
                            </div>
                        </article>
                    @empty
                        <div class="rounded-lg border border-dashed border-slate-300 bg-slate-50 px-4 py-6 text-sm text-slate-500 text-center">
                            No routine blocks yet. Add your first time block above — e.g. morning workout, focused work, meals, wind-down.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <section class="rounded-xl bg-white p-5 mt-6 panel dashboard-content-panel" data-dashboard-panel="money">
        <h2 class="text-lg font-semibold">Stock Value</h2>
        <p class="text-sm text-slate-500 mt-1">Invested stock amount shown separately.</p>
        <div class="mt-4 flex flex-wrap items-center justify-between gap-3 rounded-xl border border-[rgba(22,227,138,0.28)] bg-gradient-to-r from-[rgba(22,227,138,0.16)] to-[rgba(8,51,45,0.85)] px-5 py-6 text-[var(--white)] shadow">
                <div>
                <p class="text-xs uppercase tracking-wide text-[var(--gray)]">Current Total</p>
                <p class="text-3xl font-semibold mt-2 text-indigo-900">Rs {{ number_format($totalStockValue, 2) }}</p>
            </div>
            <button type="button" class="primary-btn px-3 py-2 text-xs open-modal" data-modal="stockCreateModal">
                <i class="fa-solid fa-plus text-[10px]"></i> Add Stock
            </button>
        </div>
    </section>

    <section class="rounded-xl bg-white p-5 mt-6 panel dashboard-content-panel" data-dashboard-panel="money">
        <h2 class="text-lg font-semibold">Stock History</h2>
        <p class="text-sm text-slate-500 mt-1">Manage stock holdings with full CRUD.</p>
        <div class="history-table-wrap mt-4 overflow-x-auto">
            <table class="history-table">
                <thead>
                <tr>
                    <th>Symbol</th>
                    <th>Name</th>
                    <th class="text-right">Quantity</th>
                    <th class="text-right">Current Value</th>
                    <th>Notes</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($stockHoldings as $stock)
                    <tr>
                        <td class="whitespace-nowrap">{{ $stock->symbol ?: '-' }}</td>
                        <td>{{ $stock->name }}</td>
                        <td class="whitespace-nowrap text-right tabular-nums">{{ number_format((float) $stock->quantity, 4) }}</td>
                        <td class="whitespace-nowrap text-right tabular-nums font-medium text-indigo-700">Rs {{ number_format((float) $stock->current_value, 2) }}</td>
                        <td class="history-note-cell">{{ $stock->notes ?: '-' }}</td>
                        <td>
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" class="card-action-btn open-modal" data-modal="stockEditModal{{ $stock->id }}" title="Edit" aria-label="Edit">
                                    <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                                </button>
                                <form method="post" action="{{ route('admin.stocks.delete', $stock) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="card-action-btn card-action-btn-danger" title="Delete" aria-label="Delete">
                                        <i class="fa-solid fa-trash text-[10px]"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-slate-500">No stock holdings added yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $stockHoldings->links() }}</div>
    </section>

    <section class="rounded-xl bg-white p-5 mt-6 panel dashboard-content-panel" data-dashboard-panel="money">
        <div class="flex items-center justify-between gap-3 mb-4">
            <h2 class="text-lg font-semibold">Cards Overview</h2>
            <button type="button" class="primary-btn px-3 py-2 text-xs open-modal" data-modal="debitCardCreateModal">
                <i class="fa-solid fa-plus text-[10px]"></i> Add Bank Card
            </button>
        </div>
        <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-4">
            @forelse ($creditCards as $card)
                <article class="finance-card credit-visual card-editable" data-modal="creditCardEditModal{{ $card->id }}" role="button" tabindex="0" aria-label="Edit {{ $card->name }}">
                    <div class="relative z-10">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-[11px] uppercase tracking-wide/4 opacity-75">Credit Card</p>
                                <p class="text-sm font-semibold mt-1">{{ $card->name }}</p>
                            </div>
                            <i class="fa-brands fa-cc-visa text-2xl opacity-85"></i>
                        </div>
                        <p class="text-[11px] mt-5 opacity-80">Used / Limit</p>
                        <p class="text-base font-semibold">Rs {{ number_format((float) $card->used_amount, 2) }} / {{ number_format((float) $card->total_limit, 2) }}</p>
                        <p class="text-[11px] mt-2 opacity-80">
                            {{ (float) $card->total_limit > 0 ? number_format(((float) $card->used_amount / (float) $card->total_limit) * 100, 1) : '0.0' }}% used
                        </p>
                        <div class="card-actions">
                            <button type="button" class="card-action-btn open-modal" data-modal="creditCardEditModal{{ $card->id }}" title="Edit" aria-label="Edit">
                                <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                            </button>
                            <form method="post" action="{{ route('admin.credit-cards.delete', $card) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="card-action-btn card-action-btn-danger" title="Delete" aria-label="Delete">
                                    <i class="fa-solid fa-trash text-[10px]"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @empty
                <div class="rounded-lg border border-dashed border-slate-300 px-4 py-6 text-sm text-slate-500">
                    No credit cards yet.
                </div>
            @endforelse

            @forelse ($debitCards as $card)
                <article class="finance-card debit-visual card-editable" data-modal="debitCardEditModal{{ $card->id }}" role="button" tabindex="0" aria-label="Edit {{ $card->bank_name ?: $card->name }}">
                    <div class="relative z-10">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-[11px] uppercase tracking-wide/4 text-white/80">Bank Name</p>
                                <p class="text-sm font-semibold mt-1">{{ $card->bank_name ?: '-' }}</p>
                            </div>
                            <i class="fa-solid fa-building-columns text-xl text-white/90"></i>
                        </div>
                        <p class="text-[11px] mt-5 text-white/80">Debit Card</p>
                        <p class="text-sm font-medium">{{ $card->name }}</p>
                        <p class="text-[11px] mt-2 text-white/80">Savings Amount</p>
                        <p class="text-base font-semibold">Rs {{ number_format((float) $card->current_balance, 2) }}</p>
                        <div class="card-actions">
                            <button type="button" class="card-action-btn open-modal" data-modal="debitCardEditModal{{ $card->id }}" title="Edit" aria-label="Edit">
                                <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                            </button>
                            <form method="post" action="{{ route('admin.debit-cards.delete', $card) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="card-action-btn card-action-btn-danger" title="Delete" aria-label="Delete">
                                    <i class="fa-solid fa-trash text-[10px]"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @empty
                <div class="rounded-lg border border-dashed border-slate-300 px-4 py-6 text-sm text-slate-500">
                    No debit cards yet.
                </div>
            @endforelse
        </div>
        @if (method_exists($creditCards, 'links') || method_exists($debitCards, 'links'))
            <div class="mt-3 flex flex-wrap items-center gap-3">
                <div>{{ $creditCards->links() }}</div>
                <div>{{ $debitCards->links() }}</div>
            </div>
        @endif
    </section>

    <section class="rounded-xl bg-white p-5 mt-6 panel dashboard-content-panel" data-dashboard-panel="money">
        <h2 class="text-lg font-semibold">Expense History</h2>
        <p class="text-sm text-slate-500 mt-1">Neat tabular view with direct edit and delete actions.</p>
        <div class="history-table-wrap mt-4 overflow-x-auto">
            <table class="history-table">
                <thead>
                <tr>
                    <th class="text-left">Date</th>
                    <th class="text-left">Title</th>
                    <th class="text-left">Category</th>
                    <th class="text-left">Paid From</th>
                    <th class="text-left">Type</th>
                    <th class="text-left">Amount</th>
                    <th class="text-left">Notes</th>
                    <th class="text-left">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($expenses as $expense)
                    <tr>
                        <td class="whitespace-nowrap">{{ $expense->spent_on->format('d M') }}</td>
                        <td class="font-medium text-slate-800">{{ $expense->title }}</td>
                        <td>{{ $expense->category?->name ?: '-' }}</td>
                        <td class="whitespace-nowrap">
                            @if ($expense->payment_channel === 'credit_card')
                                Credit - {{ $expense->creditCard?->name ?: '-' }}
                            @elseif ($expense->payment_channel === 'debit_card')
                                {{ $expense->debitCard?->bank_name ?: '-' }}
                            @else
                                Cash in hand
                            @endif
                        </td>
                        <td>
                            @if ($expense->is_emi)
                                <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-semibold bg-amber-100 text-amber-900">EMI</span>
                            @else
                                <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-semibold bg-slate-100 text-slate-700">Regular</span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap font-semibold text-rose-700">Rs {{ number_format((float) $expense->amount, 2) }}</td>
                        <td class="history-note-cell">{{ $expense->notes ?: '-' }}</td>
                        <td class="history-action-cell">
                            <div class="flex items-center gap-2">
                                <button type="button" class="card-action-btn open-modal" data-modal="expenseEditModal{{ $expense->id }}" title="Edit" aria-label="Edit">
                                    <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                                </button>
                                <form method="post" action="{{ route('admin.expenses.delete', $expense) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="card-action-btn card-action-btn-danger" title="Delete" aria-label="Delete">
                                        <i class="fa-solid fa-trash text-[10px]"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center px-3 py-6 text-slate-500">No expenses found in this range.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $expenses->links() }}</div>
    </section>

    <section class="rounded-xl bg-white p-5 mt-6 panel dashboard-content-panel" data-dashboard-panel="money">
        <h2 class="text-lg font-semibold">Income History</h2>
        <p class="text-sm text-slate-500 mt-1">Clean rows and columns for quick review and updates.</p>
        <div class="history-table-wrap mt-4 overflow-x-auto">
            <table class="history-table">
                <thead>
                <tr>
                    <th class="text-left">Date</th>
                    <th class="text-left">Title</th>
                    <th class="text-left">Source</th>
                    <th class="text-left">Received In</th>
                    <th class="text-left">Amount</th>
                    <th class="text-left">Notes</th>
                    <th class="text-left">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($incomes as $income)
                    <tr>
                        <td class="whitespace-nowrap">{{ $income->received_on->format('d M') }}</td>
                        <td class="font-medium text-slate-800">{{ $income->title }}</td>
                        <td>{{ $income->source ?: '-' }}</td>
                        <td class="whitespace-nowrap">
                            @if ($income->payment_channel === 'credit_card')
                                Credit - {{ $income->creditCard?->name ?: '-' }}
                            @elseif ($income->payment_channel === 'debit_card')
                                {{ $income->debitCard?->bank_name ?: '-' }}
                            @else
                                Cash in hand
                            @endif
                        </td>
                        <td class="whitespace-nowrap font-semibold text-emerald-700">Rs {{ number_format((float) $income->amount, 2) }}</td>
                        <td class="history-note-cell">{{ $income->notes ?: '-' }}</td>
                        <td class="history-action-cell">
                            <div class="flex items-center gap-2">
                                <button type="button" class="card-action-btn open-modal" data-modal="incomeEditModal{{ $income->id }}" title="Edit" aria-label="Edit">
                                    <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                                </button>
                                <form method="post" action="{{ route('admin.incomes.delete', $income) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="card-action-btn card-action-btn-danger" title="Delete" aria-label="Delete">
                                        <i class="fa-solid fa-trash text-[10px]"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center px-3 py-6 text-slate-500">No income records found in this range.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $incomes->links() }}</div>
    </section>

    <section class="rounded-xl bg-white p-5 mt-6 panel dashboard-content-panel" data-dashboard-panel="goal">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="text-lg font-semibold">Net worth analysis ({{ $netWorthMonthlyTrend['year'] }})</h2>
                <p class="text-sm text-slate-500 mt-1">Built only from your income and expense records. Solid bars are closed months (actual). Lighter bars are forecast. The current month blends what you logged so far with a projected finish. The line uses actual history through the last closed month, then extends with those monthly figures.</p>
            </div>
            <form method="get" action="{{ route('admin.dashboard') }}" class="expense-filter-form flex flex-wrap items-center gap-2">
                <input type="hidden" name="period" value="{{ $period }}">
                <input type="hidden" name="month" value="{{ $selectedMonth }}">
                <select name="year" class="soft-input rounded-lg px-3 py-2 text-sm">
                    @for ($yearOption = now()->year + 1; $yearOption >= now()->year - 10; $yearOption--)
                        <option value="{{ $yearOption }}" @selected($selectedYear === $yearOption)>{{ $yearOption }}</option>
                    @endfor
                </select>
                <button class="primary-btn px-4 py-2 text-sm">Apply</button>
            </form>
        </div>
        @php($fc = $netWorthMonthlyTrend['forecast'] ?? [])
        <div class="mt-4 grid gap-3 sm:grid-cols-2 rounded-xl border border-slate-200 bg-slate-50/80 p-4">
            <div>
                <p class="text-[11px] font-semibold uppercase text-slate-500">This month (forecast)</p>
                <p class="text-lg font-semibold text-indigo-800 mt-1">{{ $fc['this_month_label'] ?? '' }}</p>
                <p class="text-xl font-semibold mt-0.5 {{ ($fc['this_month_rs'] ?? 0) >= 0 ? 'text-emerald-700' : 'text-rose-700' }}">Rs {{ number_format((float) ($fc['this_month_rs'] ?? 0), 2) }}</p>
            </div>
            <div>
                <p class="text-[11px] font-semibold uppercase text-slate-500">Next month (forecast)</p>
                <p class="text-lg font-semibold text-indigo-800 mt-1">{{ $fc['next_month_label'] ?? '' }}</p>
                <p class="text-xl font-semibold mt-0.5 {{ ($fc['next_month_rs'] ?? 0) >= 0 ? 'text-emerald-700' : 'text-rose-700' }}">Rs {{ number_format((float) ($fc['next_month_rs'] ?? 0), 2) }}</p>
            </div>
            <p class="text-xs text-slate-600 sm:col-span-2">{{ $fc['confidence_note'] ?? '' }} Avg monthly net used in forecasts: Rs {{ number_format((float) ($fc['avg_monthly_net_rs'] ?? 0), 2) }}.</p>
        </div>
        <div class="grid md:grid-cols-2 gap-3 mt-4">
            <div class="rounded-xl border border-indigo-100 bg-gradient-to-br from-indigo-50 via-sky-50 to-cyan-50 p-3 shadow-sm">
                <p class="text-xs uppercase tracking-wide text-slate-600 mb-2">Monthly net (income − expense, incl. forecast)</p>
                <canvas id="netWorthBarChart" height="140"></canvas>
            </div>
            <div class="rounded-xl border border-teal-100 bg-gradient-to-br from-emerald-50 via-cyan-50 to-blue-50 p-3 shadow-sm">
                <p class="text-xs uppercase tracking-wide text-slate-600 mb-2">Cumulative flow (actual + projected)</p>
                <canvas id="netWorthLineChart" height="140"></canvas>
            </div>
        </div>
        <div class="history-table-wrap mt-4 overflow-x-auto">
            <table class="history-table">
                <thead>
                <tr>
                    <th class="text-left">Month</th>
                    <th class="text-left">Monthly net</th>
                    <th class="text-left">Type</th>
                    <th class="text-left">Cumulative</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($netWorthMonthlyTrend['labels'] as $idx => $monthLabel)
                    @php($monthly = $netWorthMonthlyTrend['monthly_net'][$idx] ?? 0)
                    @php($cumulative = $netWorthMonthlyTrend['cumulative_flow'][$idx] ?? 0)
                    @php($kind = $netWorthMonthlyTrend['monthly_kinds'][$idx] ?? 'actual')
                    @php($kindLabel = $kind === 'blend' ? 'Blend' : ($kind === 'forecast' ? 'Forecast' : 'Actual'))
                    <tr>
                        <td class="font-medium text-slate-800">{{ $monthLabel }}</td>
                        <td class="whitespace-nowrap font-semibold {{ (float) $monthly >= 0 ? 'text-cyan-700' : 'text-rose-700' }}">
                            Rs {{ number_format((float) $monthly, 2) }}
                        </td>
                        <td class="text-xs text-slate-600">{{ $kindLabel }}</td>
                        <td class="whitespace-nowrap font-semibold {{ (float) $cumulative >= 0 ? 'text-cyan-700' : 'text-rose-700' }}">
                            Rs {{ number_format((float) $cumulative, 2) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <h3 class="text-sm font-semibold text-slate-800 mt-6">By calendar year (all-time)</h3>
        <p class="text-xs text-slate-500 mt-1">Totals from every income and expense row grouped by year.</p>
        <div class="history-table-wrap mt-3 overflow-x-auto">
            <table class="history-table">
                <thead>
                <tr>
                    <th class="text-left">Year</th>
                    <th class="text-left">Income</th>
                    <th class="text-left">Expense</th>
                    <th class="text-left">Net</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($netWorthEntries as $row)
                    <tr>
                        <td class="font-medium text-slate-800">{{ $row['year'] }}</td>
                        <td class="whitespace-nowrap text-emerald-700 font-semibold">Rs {{ number_format((float) $row['income'], 2) }}</td>
                        <td class="whitespace-nowrap text-rose-700 font-semibold">Rs {{ number_format((float) $row['expense'], 2) }}</td>
                        <td class="whitespace-nowrap font-semibold {{ (float) $row['net'] >= 0 ? 'text-cyan-700' : 'text-rose-700' }}">
                            Rs {{ number_format((float) $row['net'], 2) }}
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center px-3 py-6 text-slate-500">No income or expense data yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section class="rounded-xl bg-white p-5 mt-6 panel dashboard-content-panel" data-dashboard-panel="fitness">
        <div class="flex items-center justify-between gap-3">
            <div>
                <h2 class="text-lg font-semibold">Weight Management</h2>
                <p class="text-sm text-slate-500 mt-1">Track daily weight, walking, calories, macros, and intake details.</p>
            </div>
            <button type="button" class="primary-btn px-3 py-2 text-xs open-modal" data-modal="weightLogCreateModal">
                <i class="fa-solid fa-plus text-[10px]"></i> Add Daily Entry
            </button>
        </div>
        <div class="grid md:grid-cols-2 gap-4 mt-4">
            <div class="rounded-xl border border-cyan-100 bg-gradient-to-br from-cyan-50 via-sky-50 to-blue-50 p-3 shadow-sm">
                <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                    <p class="text-xs uppercase tracking-wide text-slate-600">Weight Progress</p>
                    <span class="inline-flex items-center rounded-full bg-white/80 border border-cyan-200 px-2 py-0.5 text-[11px] font-semibold text-cyan-700">
                        Goal: 75 kg
                    </span>
                </div>
                <p id="weightGoalStatus" class="text-xs text-slate-600 mb-2"></p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 mb-2">
                    <div class="rounded-lg bg-white/80 border border-slate-200 px-2 py-1.5">
                        <p class="text-[10px] uppercase text-slate-500">Prev Best</p>
                        <p class="text-sm font-semibold text-slate-800">80.50 kg</p>
                    </div>
                    <div class="rounded-lg bg-white/80 border border-slate-200 px-2 py-1.5">
                        <p class="text-[10px] uppercase text-slate-500">Prev Avg</p>
                        <p class="text-sm font-semibold text-slate-800">85.00 kg</p>
                    </div>
                    <div class="rounded-lg bg-white/80 border border-slate-200 px-2 py-1.5">
                        <p class="text-[10px] uppercase text-slate-500">Now</p>
                        <p class="text-sm font-semibold text-rose-700">89.90 kg</p>
                    </div>
                </div>
                <p id="weightDeltaStatus" class="text-xs text-slate-600 mb-2"></p>
                <div class="weight-progress-chart-wrap">
                    <canvas id="weightProgressChart"></canvas>
                </div>
            </div>
            <div class="weight-total-card rounded-xl border border-amber-100 bg-gradient-to-br from-amber-50 via-orange-50 to-rose-50 p-4 shadow-sm">
                <p class="text-xs uppercase tracking-wide text-slate-600 mb-2">Daily Calories (Hologram)</p>
                <div class="weight-calorie-chart-wrap">
                    <canvas id="dailyCaloriesChart"></canvas>
                </div>
            </div>
        </div>
        <div class="history-table-wrap mt-4 overflow-x-auto">
            <table class="history-table">
                <thead>
                <tr>
                    <th class="text-left">Date</th>
                    <th class="text-left">Weight (kg)</th>
                    <th class="text-left">Walked</th>
                    <th class="text-left">Walk (km)</th>
                    <th class="text-left">Calories</th>
                    <th class="text-left">Macros (C/P/F)</th>
                    <th class="text-left">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($weightLogs as $log)
                    <tr>
                        <td class="whitespace-nowrap font-medium text-slate-800">{{ optional($log->logged_on)->format('d-m-Y') }}</td>
                        <td class="whitespace-nowrap">{{ number_format((float) $log->weight_kg, 2) }}</td>
                        <td>
                            @if ($log->did_walk)
                                <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-semibold bg-emerald-100 text-emerald-800">Yes</span>
                            @else
                                <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-semibold bg-slate-100 text-slate-700">No</span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap">{{ $log->walk_km !== null ? number_format((float) $log->walk_km, 2) : '-' }}</td>
                        <td class="whitespace-nowrap">{{ $log->calories_intake ?? '-' }}</td>
                        <td class="whitespace-nowrap">
                            {{ $log->carbs_g !== null ? number_format((float) $log->carbs_g, 0) : '-' }}/{{ $log->protein_g !== null ? number_format((float) $log->protein_g, 0) : '-' }}/{{ $log->fat_g !== null ? number_format((float) $log->fat_g, 0) : '-' }}
                        </td>
                        <td class="history-action-cell">
                            <div class="flex items-center gap-2">
                                <button type="button" class="card-action-btn open-modal" data-modal="weightLogEditModal{{ $log->id }}" title="Edit" aria-label="Edit">
                                    <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                                </button>
                                <form method="post" action="{{ route('admin.weight-logs.delete', $log) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="card-action-btn card-action-btn-danger" title="Delete" aria-label="Delete">
                                        <i class="fa-solid fa-trash text-[10px]"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center px-3 py-6 text-slate-500">No weight entries yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $weightLogs->links() }}</div>
    </section>
</div>
</div>

<dialog id="categoryCreateModal" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-tags text-xs"></i></span>Add Category</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.categories.store') }}" class="grid gap-3">
        @csrf
        <input name="name" required placeholder="New category" class="soft-input rounded-lg px-3 py-2 text-sm">
        <button class="primary-btn success-btn px-4 py-2 text-sm">Create</button>
    </form>
</dialog>

<dialog id="expenseCreateModal" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-wallet text-xs"></i></span>Add Expense</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.expenses.store') }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        <input type="text" name="title" placeholder="Expense title" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <select name="expense_category_id" required class="soft-input rounded-lg px-3 py-2 text-sm">
            <option value="">Select category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <select name="payment_channel" class="soft-input rounded-lg px-3 py-2 text-sm" required>
            <option value="cash">Cash in hand</option>
            <option value="debit_card">Debit card / bank</option>
            <option value="credit_card">Credit card</option>
        </select>
        <select name="debit_card_id" class="soft-input rounded-lg px-3 py-2 text-sm">
            <option value="">Select bank name (if using bank)</option>
            @foreach ($debitCardOptions as $card)
                <option value="{{ $card->id }}">{{ $card->bank_name ?: '-' }}</option>
            @endforeach
        </select>
        <select name="credit_card_id" class="soft-input rounded-lg px-3 py-2 text-sm">
            <option value="">Select credit card (if using credit)</option>
            @foreach ($creditCardOptions as $card)
                <option value="{{ $card->id }}">{{ $card->name }}</option>
            @endforeach
        </select>
        <input type="number" name="amount" step="0.01" min="0.01" required placeholder="Amount" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="date" name="spent_on" required value="{{ now()->toDateString() }}" class="soft-input rounded-lg px-3 py-2 text-sm">
        <label class="md:col-span-2 inline-flex items-center gap-2 text-sm text-slate-700">
            <input type="checkbox" name="is_emi" value="1">
            Mark as EMI (excluded from expense totals and pie chart)
        </label>
        <input type="text" name="notes" placeholder="Notes (optional)" class="soft-input rounded-lg px-3 py-2 text-sm md:col-span-2">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Save Expense</button>
    </form>
</dialog>

<dialog id="incomeCreateModal" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-money-bill-trend-up text-xs"></i></span>Add Income</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.incomes.store') }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        <input type="text" name="title" placeholder="Income title" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="source" placeholder="Source (optional)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <select name="payment_channel" class="soft-input rounded-lg px-3 py-2 text-sm" required>
            <option value="cash">Cash in hand</option>
            <option value="debit_card">Debit card / bank</option>
            <option value="credit_card">Credit card repayment</option>
        </select>
        <select name="debit_card_id" class="soft-input rounded-lg px-3 py-2 text-sm">
            <option value="">Select bank name (if income goes to bank)</option>
            @foreach ($debitCardOptions as $card)
                <option value="{{ $card->id }}">{{ $card->bank_name ?: '-' }}</option>
            @endforeach
        </select>
        <select name="credit_card_id" class="soft-input rounded-lg px-3 py-2 text-sm">
            <option value="">Select credit card (if paying card due)</option>
            @foreach ($creditCardOptions as $card)
                <option value="{{ $card->id }}">{{ $card->name }}</option>
            @endforeach
        </select>
        <input type="number" name="amount" step="0.01" min="0.01" required placeholder="Amount" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="date" name="received_on" required value="{{ now()->toDateString() }}" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="notes" placeholder="Notes (optional)" class="soft-input rounded-lg px-3 py-2 text-sm md:col-span-2">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Save Income</button>
    </form>
</dialog>

@foreach ($expenses as $expense)
<dialog id="expenseEditModal{{ $expense->id }}" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-wallet text-xs"></i></span>Edit Expense</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.expenses.update', $expense) }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        @method('put')
        <input type="text" name="title" value="{{ $expense->title }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <select name="expense_category_id" required class="soft-input rounded-lg px-3 py-2 text-sm">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected($expense->expense_category_id === $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        <select name="payment_channel" class="soft-input rounded-lg px-3 py-2 text-sm" required>
            <option value="cash" @selected(($expense->payment_channel ?? 'cash') === 'cash')>Cash in hand</option>
            <option value="debit_card" @selected($expense->payment_channel === 'debit_card')>Debit card / bank</option>
            <option value="credit_card" @selected($expense->payment_channel === 'credit_card')>Credit card</option>
        </select>
        <select name="debit_card_id" class="soft-input rounded-lg px-3 py-2 text-sm">
            <option value="">Select bank name (if using bank)</option>
            @foreach ($debitCardOptions as $card)
                <option value="{{ $card->id }}" @selected((int) $expense->debit_card_id === (int) $card->id)>{{ $card->bank_name ?: '-' }}</option>
            @endforeach
        </select>
        <select name="credit_card_id" class="soft-input rounded-lg px-3 py-2 text-sm">
            <option value="">Select credit card (if using credit)</option>
            @foreach ($creditCardOptions as $card)
                <option value="{{ $card->id }}" @selected((int) $expense->credit_card_id === (int) $card->id)>{{ $card->name }}</option>
            @endforeach
        </select>
        <input type="number" name="amount" step="0.01" min="0.01" value="{{ (float) $expense->amount }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="date" name="spent_on" value="{{ optional($expense->spent_on)->toDateString() }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <label class="md:col-span-2 inline-flex items-center gap-2 text-sm text-slate-700">
            <input type="checkbox" name="is_emi" value="1" @checked($expense->is_emi)>
            Mark as EMI (excluded from expense totals and pie chart)
        </label>
        <input type="text" name="notes" value="{{ $expense->notes }}" placeholder="Notes (optional)" class="soft-input rounded-lg px-3 py-2 text-sm md:col-span-2">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Update Expense</button>
    </form>
</dialog>
@endforeach

@foreach ($incomes as $income)
<dialog id="incomeEditModal{{ $income->id }}" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-money-bill-trend-up text-xs"></i></span>Edit Income</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.incomes.update', $income) }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        @method('put')
        <input type="text" name="title" value="{{ $income->title }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="source" value="{{ $income->source }}" placeholder="Source (optional)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <select name="payment_channel" class="soft-input rounded-lg px-3 py-2 text-sm" required>
            <option value="cash" @selected(($income->payment_channel ?? 'cash') === 'cash')>Cash in hand</option>
            <option value="debit_card" @selected($income->payment_channel === 'debit_card')>Debit card / bank</option>
            <option value="credit_card" @selected($income->payment_channel === 'credit_card')>Credit card repayment</option>
        </select>
        <select name="debit_card_id" class="soft-input rounded-lg px-3 py-2 text-sm">
            <option value="">Select bank name (if income goes to bank)</option>
            @foreach ($debitCardOptions as $card)
                <option value="{{ $card->id }}" @selected((int) $income->debit_card_id === (int) $card->id)>{{ $card->bank_name ?: '-' }}</option>
            @endforeach
        </select>
        <select name="credit_card_id" class="soft-input rounded-lg px-3 py-2 text-sm">
            <option value="">Select credit card (if paying card due)</option>
            @foreach ($creditCardOptions as $card)
                <option value="{{ $card->id }}" @selected((int) $income->credit_card_id === (int) $card->id)>{{ $card->name }}</option>
            @endforeach
        </select>
        <input type="number" name="amount" step="0.01" min="0.01" value="{{ (float) $income->amount }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="date" name="received_on" value="{{ optional($income->received_on)->toDateString() }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="notes" value="{{ $income->notes }}" placeholder="Notes (optional)" class="soft-input rounded-lg px-3 py-2 text-sm md:col-span-2">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Update Income</button>
    </form>
</dialog>
@endforeach

<dialog id="creditCardCreateModal" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-credit-card text-xs"></i></span>Add Credit Card</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.credit-cards.store') }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        <input type="text" name="name" placeholder="Card name" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="total_limit" step="0.01" min="0" required placeholder="Total limit" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="used_amount" step="0.01" min="0" required placeholder="Used amount" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="notes" placeholder="Notes (optional)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Save Credit Card</button>
    </form>
</dialog>

<dialog id="debitCardCreateModal" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-building-columns text-xs"></i></span>Add Debit Card</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.debit-cards.store') }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        <input type="text" name="name" placeholder="Card name" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="bank_name" placeholder="Bank name (optional)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="current_balance" step="0.01" required placeholder="Savings amount in bank (can be negative)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="notes" placeholder="Notes (optional)" class="soft-input rounded-lg px-3 py-2 text-sm md:col-span-2">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Save Debit Card</button>
    </form>
</dialog>

@foreach ($creditCards as $card)
<dialog id="creditCardEditModal{{ $card->id }}" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-credit-card text-xs"></i></span>Edit Credit Card</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.credit-cards.update', $card) }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        @method('put')
        <input type="text" name="name" value="{{ $card->name }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="total_limit" step="0.01" min="0" value="{{ (float) $card->total_limit }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="used_amount" step="0.01" min="0" value="{{ (float) $card->used_amount }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="notes" value="{{ $card->notes }}" placeholder="Notes (optional)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Update Credit Card</button>
    </form>
</dialog>
@endforeach

@foreach ($debitCards as $card)
<dialog id="debitCardEditModal{{ $card->id }}" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-building-columns text-xs"></i></span>Edit Debit Card</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.debit-cards.update', $card) }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        @method('put')
        <input type="text" name="name" value="{{ $card->name }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="bank_name" value="{{ $card->bank_name }}" placeholder="Bank name (optional)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="current_balance" step="0.01" value="{{ (float) $card->current_balance }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="notes" value="{{ $card->notes }}" placeholder="Notes (optional)" class="soft-input rounded-lg px-3 py-2 text-sm md:col-span-2">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Update Debit Card</button>
    </form>
</dialog>
@endforeach

@foreach ($routineItems as $item)
<dialog id="routineEditModal{{ $item->id }}" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-clock text-xs"></i></span>Edit Routine Block</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.routine-items.update', $item) }}" class="routine-block-form grid md:grid-cols-2 gap-3">
        @csrf
        @method('put')
        <input type="hidden" name="routine_date" value="{{ $routineDate }}">
        <input type="hidden" name="period" value="{{ $period }}">
        <input type="hidden" name="year" value="{{ $selectedYear }}">
        <input type="hidden" name="month" value="{{ $selectedMonth }}">
        <label class="block">
            <span class="routine-time-label">Time in</span>
            <input type="time" name="scheduled_time" value="{{ old('scheduled_time', $item->startTimeLabel()) }}" required class="soft-input rounded-lg px-3 py-2 text-sm w-full">
        </label>
        <label class="block">
            <span class="routine-time-label">Time out</span>
            <input type="time" name="end_time" value="{{ old('end_time', $item->endTimeLabel()) }}" required class="soft-input rounded-lg px-3 py-2 text-sm w-full">
            <span class="text-[10px] text-slate-500 mt-1 block">Can be next day (after 00:00)</span>
        </label>
        <p class="routine-duration-preview md:col-span-2">Duration: {{ $item->durationLabelWithOvernightHint() }}</p>
        <label class="block md:col-span-2">
            <span class="routine-time-label">Task</span>
            <input type="text" name="title" value="{{ old('title', $item->title) }}" required class="soft-input rounded-lg px-3 py-2 text-sm w-full">
        </label>
        <label class="block md:col-span-2">
            <span class="routine-time-label">Notes (optional)</span>
            <input type="text" name="details" value="{{ old('details', $item->details) }}" placeholder="Extra details" class="soft-input rounded-lg px-3 py-2 text-sm w-full">
        </label>
        <label class="inline-flex items-center gap-2 text-sm text-slate-700 md:col-span-2">
            <input type="checkbox" name="is_done" value="1" @checked($item->is_done)> Mark as done
        </label>
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Update Routine Block</button>
    </form>
</dialog>
@endforeach

@foreach ($stockHoldings as $stock)
<dialog id="stockEditModal{{ $stock->id }}" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-chart-column text-xs"></i></span>Edit Stock Holding</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.stocks.update', $stock) }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        @method('put')
        <input type="text" name="symbol" value="{{ $stock->symbol }}" placeholder="Symbol (optional)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="name" value="{{ $stock->name }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="quantity" step="0.0001" min="0" value="{{ (float) $stock->quantity }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="current_value" step="0.01" min="0" value="{{ (float) $stock->current_value }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="notes" value="{{ $stock->notes }}" placeholder="Notes (optional)" class="soft-input rounded-lg px-3 py-2 text-sm md:col-span-2">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Update Stock</button>
    </form>
</dialog>
@endforeach

<dialog id="stockCreateModal" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-chart-column text-xs"></i></span>Add Stock Holding</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.stocks.store') }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        <input type="text" name="symbol" placeholder="Symbol (optional)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="name" placeholder="Stock name" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="quantity" step="0.0001" min="0" required placeholder="Quantity" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="current_value" step="0.01" min="0" required placeholder="Current total value" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="notes" placeholder="Notes (optional)" class="soft-input rounded-lg px-3 py-2 text-sm md:col-span-2">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Save Stock</button>
    </form>
</dialog>

<dialog id="savingsAdjustmentCreateModal" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-scale-balanced text-xs"></i></span>Add Savings Adjustment</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.savings-adjustments.store') }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        <input type="number" name="amount" step="0.01" required placeholder="Adjustment amount (+/-)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="date" name="adjusted_on" required value="{{ now()->toDateString() }}" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="notes" placeholder="Reason / note (optional)" class="soft-input rounded-lg px-3 py-2 text-sm md:col-span-2">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Save Adjustment</button>
    </form>
</dialog>

<dialog id="cashBalanceEditModal" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-money-bill-wave text-xs"></i></span>Cash in hand</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <p class="text-sm text-slate-600 mb-3">Set the current cash balance (same idea as editing a bank card balance). Cash income and cash expenses will move this amount automatically.</p>
    <form method="post" action="{{ route('admin.cash-balance.update') }}" class="grid gap-3">
        @csrf
        @method('put')
        <input type="number" name="current_balance" step="0.01" required value="{{ $cashBalance !== null ? number_format((float) $cashBalance->current_balance, 2, '.', '') : '0' }}" placeholder="Cash balance (Rs)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm">Save balance</button>
    </form>
</dialog>

<dialog id="weightLogCreateModal" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-weight-scale text-xs"></i></span>Add Daily Weight Entry</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.weight-logs.store') }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        <input type="date" name="logged_on" required value="{{ now()->toDateString() }}" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="weight_kg" step="0.01" min="20" max="300" required placeholder="Weight (kg)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <label class="inline-flex items-center gap-2 text-sm text-slate-700">
            <input type="checkbox" name="did_walk" value="1"> Did I walk?
        </label>
        <input type="number" name="walk_km" step="0.01" min="0" max="100" placeholder="Walked KM (optional)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <p class="text-xs font-semibold uppercase text-slate-500 md:col-span-2 mt-1">Meal wise nutrition</p>
        <input type="number" name="breakfast_calories" min="0" max="5000" placeholder="Breakfast calories" class="meal-calorie-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ old('breakfast_calories') }}">
        <input type="number" name="breakfast_carbs_g" step="0.01" min="0" max="1000" placeholder="Breakfast carbs (g)" class="meal-carb-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ old('breakfast_carbs_g') }}">
        <input type="number" name="breakfast_protein_g" step="0.01" min="0" max="1000" placeholder="Breakfast protein (g)" class="meal-protein-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ old('breakfast_protein_g') }}">
        <input type="number" name="breakfast_fat_g" step="0.01" min="0" max="1000" placeholder="Breakfast fats (g)" class="meal-fat-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ old('breakfast_fat_g') }}">
        <input type="number" name="lunch_calories" min="0" max="5000" placeholder="Lunch calories" class="meal-calorie-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ old('lunch_calories') }}">
        <input type="number" name="lunch_carbs_g" step="0.01" min="0" max="1000" placeholder="Lunch carbs (g)" class="meal-carb-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ old('lunch_carbs_g') }}">
        <input type="number" name="lunch_protein_g" step="0.01" min="0" max="1000" placeholder="Lunch protein (g)" class="meal-protein-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ old('lunch_protein_g') }}">
        <input type="number" name="lunch_fat_g" step="0.01" min="0" max="1000" placeholder="Lunch fats (g)" class="meal-fat-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ old('lunch_fat_g') }}">
        <input type="number" name="dinner_calories" min="0" max="5000" placeholder="Dinner calories" class="meal-calorie-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ old('dinner_calories') }}">
        <input type="number" name="dinner_carbs_g" step="0.01" min="0" max="1000" placeholder="Dinner carbs (g)" class="meal-carb-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ old('dinner_carbs_g') }}">
        <input type="number" name="dinner_protein_g" step="0.01" min="0" max="1000" placeholder="Dinner protein (g)" class="meal-protein-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ old('dinner_protein_g') }}">
        <input type="number" name="dinner_fat_g" step="0.01" min="0" max="1000" placeholder="Dinner fats (g)" class="meal-fat-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ old('dinner_fat_g') }}">
        <input type="number" name="snacks_calories" min="0" max="5000" placeholder="Snacks calories" class="meal-calorie-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ old('snacks_calories') }}">
        <input type="number" name="snacks_carbs_g" step="0.01" min="0" max="1000" placeholder="Snacks carbs (g)" class="meal-carb-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ old('snacks_carbs_g') }}">
        <input type="number" name="snacks_protein_g" step="0.01" min="0" max="1000" placeholder="Snacks protein (g)" class="meal-protein-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ old('snacks_protein_g') }}">
        <input type="number" name="snacks_fat_g" step="0.01" min="0" max="1000" placeholder="Snacks fats (g)" class="meal-fat-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ old('snacks_fat_g') }}">
        <p class="text-xs font-semibold uppercase text-slate-500 md:col-span-2 mt-1">Auto totals</p>
        <input type="number" name="calories_intake" min="0" max="15000" placeholder="Total calories" readonly class="meal-calorie-total soft-input rounded-lg px-3 py-2 text-sm bg-slate-100">
        <input type="number" name="carbs_g" step="0.01" min="0" max="2000" placeholder="Total carbs (g)" readonly class="meal-carb-total soft-input rounded-lg px-3 py-2 text-sm bg-slate-100">
        <input type="number" name="protein_g" step="0.01" min="0" max="2000" placeholder="Total protein (g)" readonly class="meal-protein-total soft-input rounded-lg px-3 py-2 text-sm bg-slate-100">
        <input type="number" name="fat_g" step="0.01" min="0" max="2000" placeholder="Total fats (g)" readonly class="meal-fat-total soft-input rounded-lg px-3 py-2 text-sm bg-slate-100">
        <input type="text" name="intake_notes" placeholder="What I intake / notes" class="soft-input rounded-lg px-3 py-2 text-sm md:col-span-2">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Save Entry</button>
    </form>
</dialog>

@foreach ($weightLogs as $log)
<dialog id="weightLogEditModal{{ $log->id }}" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-weight-scale text-xs"></i></span>Edit Daily Weight Entry</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.weight-logs.update', $log) }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        @method('put')
        <input type="date" name="logged_on" required value="{{ optional($log->logged_on)->toDateString() }}" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="weight_kg" step="0.01" min="20" max="300" required value="{{ (float) $log->weight_kg }}" class="soft-input rounded-lg px-3 py-2 text-sm">
        <label class="inline-flex items-center gap-2 text-sm text-slate-700">
            <input type="checkbox" name="did_walk" value="1" @checked($log->did_walk)> Did I walk?
        </label>
        <input type="number" name="walk_km" step="0.01" min="0" max="100" value="{{ $log->walk_km !== null ? (float) $log->walk_km : '' }}" placeholder="Walked KM (optional)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <p class="text-xs font-semibold uppercase text-slate-500 md:col-span-2 mt-1">Meal wise nutrition</p>
        <input type="number" name="breakfast_calories" min="0" max="5000" placeholder="Breakfast calories" class="meal-calorie-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ $log->breakfast_calories }}">
        <input type="number" name="breakfast_carbs_g" step="0.01" min="0" max="1000" placeholder="Breakfast carbs (g)" class="meal-carb-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ $log->breakfast_carbs_g !== null ? (float) $log->breakfast_carbs_g : '' }}">
        <input type="number" name="breakfast_protein_g" step="0.01" min="0" max="1000" placeholder="Breakfast protein (g)" class="meal-protein-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ $log->breakfast_protein_g !== null ? (float) $log->breakfast_protein_g : '' }}">
        <input type="number" name="breakfast_fat_g" step="0.01" min="0" max="1000" placeholder="Breakfast fats (g)" class="meal-fat-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ $log->breakfast_fat_g !== null ? (float) $log->breakfast_fat_g : '' }}">
        <input type="number" name="lunch_calories" min="0" max="5000" placeholder="Lunch calories" class="meal-calorie-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ $log->lunch_calories }}">
        <input type="number" name="lunch_carbs_g" step="0.01" min="0" max="1000" placeholder="Lunch carbs (g)" class="meal-carb-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ $log->lunch_carbs_g !== null ? (float) $log->lunch_carbs_g : '' }}">
        <input type="number" name="lunch_protein_g" step="0.01" min="0" max="1000" placeholder="Lunch protein (g)" class="meal-protein-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ $log->lunch_protein_g !== null ? (float) $log->lunch_protein_g : '' }}">
        <input type="number" name="lunch_fat_g" step="0.01" min="0" max="1000" placeholder="Lunch fats (g)" class="meal-fat-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ $log->lunch_fat_g !== null ? (float) $log->lunch_fat_g : '' }}">
        <input type="number" name="dinner_calories" min="0" max="5000" placeholder="Dinner calories" class="meal-calorie-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ $log->dinner_calories }}">
        <input type="number" name="dinner_carbs_g" step="0.01" min="0" max="1000" placeholder="Dinner carbs (g)" class="meal-carb-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ $log->dinner_carbs_g !== null ? (float) $log->dinner_carbs_g : '' }}">
        <input type="number" name="dinner_protein_g" step="0.01" min="0" max="1000" placeholder="Dinner protein (g)" class="meal-protein-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ $log->dinner_protein_g !== null ? (float) $log->dinner_protein_g : '' }}">
        <input type="number" name="dinner_fat_g" step="0.01" min="0" max="1000" placeholder="Dinner fats (g)" class="meal-fat-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ $log->dinner_fat_g !== null ? (float) $log->dinner_fat_g : '' }}">
        <input type="number" name="snacks_calories" min="0" max="5000" placeholder="Snacks calories" class="meal-calorie-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ $log->snacks_calories }}">
        <input type="number" name="snacks_carbs_g" step="0.01" min="0" max="1000" placeholder="Snacks carbs (g)" class="meal-carb-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ $log->snacks_carbs_g !== null ? (float) $log->snacks_carbs_g : '' }}">
        <input type="number" name="snacks_protein_g" step="0.01" min="0" max="1000" placeholder="Snacks protein (g)" class="meal-protein-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ $log->snacks_protein_g !== null ? (float) $log->snacks_protein_g : '' }}">
        <input type="number" name="snacks_fat_g" step="0.01" min="0" max="1000" placeholder="Snacks fats (g)" class="meal-fat-input soft-input rounded-lg px-3 py-2 text-sm" value="{{ $log->snacks_fat_g !== null ? (float) $log->snacks_fat_g : '' }}">
        <p class="text-xs font-semibold uppercase text-slate-500 md:col-span-2 mt-1">Auto totals</p>
        <input type="number" name="calories_intake" min="0" max="15000" value="{{ $log->calories_intake }}" placeholder="Total calories" readonly class="meal-calorie-total soft-input rounded-lg px-3 py-2 text-sm bg-slate-100">
        <input type="number" name="carbs_g" step="0.01" min="0" max="2000" value="{{ $log->carbs_g !== null ? (float) $log->carbs_g : '' }}" placeholder="Total carbs (g)" readonly class="meal-carb-total soft-input rounded-lg px-3 py-2 text-sm bg-slate-100">
        <input type="number" name="protein_g" step="0.01" min="0" max="2000" value="{{ $log->protein_g !== null ? (float) $log->protein_g : '' }}" placeholder="Total protein (g)" readonly class="meal-protein-total soft-input rounded-lg px-3 py-2 text-sm bg-slate-100">
        <input type="number" name="fat_g" step="0.01" min="0" max="2000" value="{{ $log->fat_g !== null ? (float) $log->fat_g : '' }}" placeholder="Total fats (g)" readonly class="meal-fat-total soft-input rounded-lg px-3 py-2 text-sm bg-slate-100">
        <input type="text" name="intake_notes" value="{{ $log->intake_notes }}" placeholder="What I intake / notes" class="soft-input rounded-lg px-3 py-2 text-sm md:col-span-2">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Update Entry</button>
    </form>
</dialog>
@endforeach

<script>
    const dashboardScrollKey = 'admin_dashboard_scroll_y';
    const dashboardPanelStorageKey = 'admin_dashboard_active_panel';
    const categoryTotals = @json($categoryTotals);
    const expenseColors = ['#0ea5e9', '#14b8a6', '#f59e0b', '#f43f5e', '#6366f1', '#10b981', '#a855f7'];
    const todoKey = 'admin_todo_items';
    const initialTodos = @json($todoItems ?? []);
    const todoSyncUrl = @json(route('admin.todos.sync'));
    const csrfToken = @json(csrf_token());
    const workReportSaveUrl = @json(route('admin.work-reports.upsert'));
    const workReportBootstrap = {!! json_encode($workReportBootstrap) !!};

    const todoList = document.getElementById('todoList');
    const todoCompletedList = document.getElementById('todoCompletedList');
    const todoForm = document.getElementById('todoForm');
    const todoInput = document.getElementById('todoInput');
    const todoDueDate = document.getElementById('todoDueDate');
    const todoFilterBy = document.getElementById('todoFilterBy');
    const todoSortBy = document.getElementById('todoSortBy');
    const todoSortOrder = document.getElementById('todoSortOrder');
    const todoFilterToggle = document.getElementById('todoFilterToggle');
    const todoFilterMenu = document.getElementById('todoFilterMenu');
    const pieChart = document.getElementById('pieChart');
    const pieLegend = document.getElementById('pieLegend');
    const netWorthMonthlyTrend = @json($netWorthMonthlyTrend);
    const weightTrend = @json($weightTrend);
    const dailyFlowTrend = @json($dailyFlowTrend ?? ['labels' => [], 'income' => [], 'expense' => []]);
    const weightGoalKg = 75;
    const previousBestWeightKg = 80.5;
    const previousAvgWeightKg = 85;
    const currentReferenceWeightKg = 89.9;
    const hasValidationErrors = @json($errors->any());
    const openExpenseCreateOnError = @json($errors->any() && old('expense_category_id') !== null);
    const openIncomeCreateOnError = @json($errors->any() && old('received_on') !== null && old('expense_category_id') === null);
    const oldWeightContext = @json($errors->any() && old('weight_kg') !== null);
    const dashboardPanelCards = Array.from(document.querySelectorAll('[data-open-dashboard-panel]'));
    const dashboardPanels = Array.from(document.querySelectorAll('[data-dashboard-panel]'));
    const dashboardPanelKeys = new Set(['money', 'fitness', 'goal', 'work']);

    function consumeDashboardReturnState() {
        const raw = sessionStorage.getItem(dashboardScrollKey);
        if (raw === null) {
            return null;
        }
        sessionStorage.removeItem(dashboardScrollKey);
        if (hasValidationErrors) {
            return null;
        }
        try {
            const parsed = JSON.parse(raw);
            if (parsed && typeof parsed === 'object') {
                const y = Number(parsed.y);
                const panel = dashboardPanelKeys.has(parsed.panel) ? parsed.panel : 'money';
                if (!Number.isNaN(y)) {
                    return { y, panel };
                }
            }
        } catch (e) {
            /* legacy plain number */
        }
        const legacyY = Number(raw);
        if (!Number.isNaN(legacyY)) {
            return { y: legacyY, panel: 'money' };
        }
        return null;
    }

    function getVisibleDashboardPanelKey() {
        const el = dashboardPanels.find((panel) => panel.classList.contains('is-visible'));
        return el?.dataset?.dashboardPanel || '';
    }

    function inferDashboardPanelFromForm(form) {
        const action = String(form.getAttribute('action') || '');
        if (action.includes('weight-logs')) {
            return 'fitness';
        }
        if (action.includes('todos') || action.includes('routine-items') || action.includes('daily-notes')) {
            return 'goal';
        }
        if (action.includes('/admin/expenses') || action.includes('/admin/incomes') || action.includes('/admin/credit-cards') || action.includes('/admin/debit-cards') || action.includes('/admin/stocks') || action.includes('/admin/savings-adjustments') || action.includes('/admin/categories') || action.includes('/admin/cash-balance')) {
            return 'money';
        }
        const visible = getVisibleDashboardPanelKey();
        if (dashboardPanelKeys.has(visible)) {
            return visible;
        }
        const inPanel = form.closest('[data-dashboard-panel]');
        const fromAncestor = inPanel?.dataset?.dashboardPanel || '';
        if (dashboardPanelKeys.has(fromAncestor)) {
            return fromAncestor;
        }
        return 'money';
    }

    function scheduleDashboardScrollRestore(y) {
        if (typeof y !== 'number' || Number.isNaN(y)) {
            return;
        }
        function applyScroll() {
            const doc = document.documentElement;
            const body = document.body;
            const scrollHeight = Math.max(
                doc?.scrollHeight || 0,
                body?.scrollHeight || 0,
            );
            const maxY = Math.max(0, scrollHeight - window.innerHeight);
            window.scrollTo({ top: Math.min(Math.max(0, y), maxY), behavior: 'auto' });
        }
        applyScroll();
        window.requestAnimationFrame(() => {
            applyScroll();
            window.requestAnimationFrame(applyScroll);
        });
        window.addEventListener('load', applyScroll, { once: true });
        [0, 80, 200, 450].forEach((ms) => window.setTimeout(applyScroll, ms));
    }

    function bindDashboardCrudScrollMemory() {
        document.querySelectorAll('form[method="post"]').forEach((form) => {
            form.addEventListener('submit', () => {
                const action = String(form.getAttribute('action') || '');
                if (action.includes('logout')) {
                    return;
                }
                const payload = {
                    y: window.scrollY || 0,
                    panel: inferDashboardPanelFromForm(form),
                };
                sessionStorage.setItem(dashboardScrollKey, JSON.stringify(payload));
            });
        });
    }

    function bindExpensePeriodFilter() {
        document.querySelectorAll('.expense-filter-form select[name="period"]').forEach((periodSelect) => {
            const form = periodSelect.closest('form');
            if (!form) {
                return;
            }
            const monthField = form.querySelector('[data-filter-month]');
            const applyVisibility = () => {
                const showMonth = periodSelect.value !== 'year';
                if (monthField) {
                    monthField.style.display = showMonth ? '' : 'none';
                    monthField.disabled = !showMonth;
                }
            };
            periodSelect.addEventListener('change', applyVisibility);
            applyVisibility();
        });
    }

    function bindPaymentChannelDependencies() {
        const paymentForms = document.querySelectorAll('form[action*="/admin/expenses"], form[action*="/admin/incomes"]');

        paymentForms.forEach((form) => {
            const paymentChannelField = form.querySelector('select[name="payment_channel"]');
            const debitCardField = form.querySelector('select[name="debit_card_id"]');
            const creditCardField = form.querySelector('select[name="credit_card_id"]');
            if (!paymentChannelField || !debitCardField || !creditCardField) {
                return;
            }

            const applyFieldState = () => {
                const channel = paymentChannelField.value || 'cash';

                if (channel === 'debit_card') {
                    debitCardField.disabled = false;
                    debitCardField.required = true;
                    creditCardField.required = false;
                    creditCardField.value = '';
                    creditCardField.disabled = true;
                    return;
                }

                if (channel === 'credit_card') {
                    creditCardField.disabled = false;
                    creditCardField.required = true;
                    debitCardField.required = false;
                    debitCardField.value = '';
                    debitCardField.disabled = true;
                    return;
                }

                debitCardField.required = false;
                creditCardField.required = false;
                debitCardField.value = '';
                creditCardField.value = '';
                debitCardField.disabled = true;
                creditCardField.disabled = true;
            };

            paymentChannelField.addEventListener('change', applyFieldState);
            applyFieldState();
        });
    }

    function openModalById(modalId) {
        const modal = document.getElementById(modalId);
        if (!modal) {
            return;
        }
        if (typeof modal.showModal === 'function') {
            modal.showModal();
        } else {
            modal.setAttribute('open', 'open');
        }
        modal.classList.add('modal-backdrop');
    }

    function bindDashboardModals() {
        document.addEventListener('click', (event) => {
            if (event.target.closest('.card-action-btn-danger, form[method="post"] button[type="submit"]')) {
                return;
            }

            const openTarget = event.target.closest('.open-modal, .card-editable[data-modal]');
            if (openTarget?.dataset?.modal) {
                event.preventDefault();
                event.stopPropagation();
                openModalById(openTarget.dataset.modal);
                return;
            }

            const closeButton = event.target.closest('.close-modal');
            if (closeButton) {
                const modal = closeButton.closest('dialog');
                if (modal) {
                    if (typeof modal.close === 'function') {
                        modal.close();
                    } else {
                        modal.removeAttribute('open');
                    }
                }
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key !== 'Enter' && event.key !== ' ') {
                return;
            }
            const card = event.target.closest('.card-editable[data-modal]');
            if (!card || event.target.closest('.card-actions')) {
                return;
            }
            event.preventDefault();
            openModalById(card.dataset.modal);
        });

        document.querySelectorAll('dialog.app-modal').forEach((modal) => {
            modal.addEventListener('click', (event) => {
                if (event.target !== modal) {
                    return;
                }
                if (typeof modal.close === 'function') {
                    modal.close();
                } else {
                    modal.removeAttribute('open');
                }
            });
        });
    }

    bindDashboardModals();

    const renderedPanelCharts = {
        money: false,
        fitness: false,
        goal: false,
    };

    function ensurePanelCharts(panelKey) {
        try {
            if (panelKey === 'money' && !renderedPanelCharts.money) {
                renderPieChart();
                renderDailyFlowHologramChart();
                renderedPanelCharts.money = true;
                return;
            }
            if (panelKey === 'fitness' && !renderedPanelCharts.fitness) {
                renderWeightProgressChart();
                renderDailyCaloriesChart();
                renderedPanelCharts.fitness = true;
                return;
            }
            if (panelKey === 'goal' && !renderedPanelCharts.goal) {
                renderNetWorthCharts();
                renderedPanelCharts.goal = true;
            }
        } catch (error) {
            console.error('Dashboard chart render failed:', error);
        }
    }

    function setActiveDashboardPanel(panelKey) {
        dashboardPanels.forEach((panel) => {
            const isMatch = panel.dataset.dashboardPanel === panelKey;
            panel.classList.toggle('is-visible', isMatch);
        });
        dashboardPanelCards.forEach((card) => {
            card.classList.toggle('is-active', card.dataset.openDashboardPanel === panelKey);
        });
        ensurePanelCharts(panelKey);
        try {
            sessionStorage.setItem(dashboardPanelStorageKey, panelKey);
        } catch (e) {
            /* ignore quota / private mode */
        }
    }

    function bindDashboardPanelCards() {
        dashboardPanelCards.forEach((card) => {
            const panelKey = card.dataset.openDashboardPanel;
            if (!panelKey) {
                return;
            }
            card.addEventListener('click', () => setActiveDashboardPanel(panelKey));
            card.addEventListener('keydown', (event) => {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    setActiveDashboardPanel(panelKey);
                }
            });
        });
    }

    const dashboardReturnState = consumeDashboardReturnState();

    document.querySelectorAll('dialog[open]').forEach((modal) => {
        if (typeof modal.close === 'function') {
            modal.close();
        } else {
            modal.removeAttribute('open');
        }
    });

    function bindRoutineDurationPreview() {
        function formatRoutineDuration(start, end) {
            if (!start || !end) {
                return '—';
            }
            const [sh, sm] = start.split(':').map((part) => Number(part));
            const [eh, em] = end.split(':').map((part) => Number(part));
            if ([sh, sm, eh, em].some((part) => Number.isNaN(part))) {
                return '—';
            }
            let minutes = (eh * 60 + em) - (sh * 60 + sm);
            let overnight = false;
            if (minutes <= 0) {
                minutes += 24 * 60;
                overnight = true;
            }
            if (minutes === 0) {
                return 'Time in and time out cannot match';
            }
            const hours = Math.floor(minutes / 60);
            const remaining = minutes % 60;
            let label = '';
            if (hours === 0) {
                label = `${minutes} min`;
            } else if (remaining === 0) {
                label = `${hours}h`;
            } else {
                label = `${hours}h ${remaining}m`;
            }
            return overnight ? `${label} (overnight)` : label;
        }

        document.querySelectorAll('.routine-block-form').forEach((form) => {
            const startInput = form.querySelector('[name="scheduled_time"]');
            const endInput = form.querySelector('[name="end_time"]');
            const preview = form.querySelector('.routine-duration-preview');
            if (!startInput || !endInput || !preview) {
                return;
            }
            const updatePreview = () => {
                preview.textContent = `Duration: ${formatRoutineDuration(startInput.value, endInput.value)}`;
            };
            startInput.addEventListener('input', updatePreview);
            startInput.addEventListener('change', updatePreview);
            endInput.addEventListener('input', updatePreview);
            endInput.addEventListener('change', updatePreview);
            updatePreview();
        });
    }

    bindDashboardCrudScrollMemory();
    bindPaymentChannelDependencies();
    bindExpensePeriodFilter();
    bindRoutineDurationPreview();
    bindWorkReportComposer();

    function bindWorkReportComposer() {
        const taskList = document.getElementById('workReportTaskList');
        const preview = document.getElementById('workReportPreview');
        const dateInput = document.getElementById('workReportDate');
        const nameInput = document.getElementById('workReportName');
        const whatsappLink = document.getElementById('workReportWhatsApp');
        const copyBtn = document.getElementById('workReportCopy');
        const addBtn = document.getElementById('workReportAddTask');
        const clearBtn = document.getElementById('workReportClearTasks');
        const sampleBtn = document.getElementById('workReportLoadSample');
        const saveBtn = document.getElementById('workReportSave');
        const saveLabel = document.getElementById('workReportSaveLabel');
        const saveStatus = document.getElementById('workReportSaveStatus');
        const tasksLabel = document.getElementById('workReportTasksLabel');
        const addTaskLabel = document.getElementById('workReportAddTaskLabel');
        const hintEl = document.getElementById('workReportHint');
        const typeButtons = Array.from(document.querySelectorAll('[data-work-report-type]'));
        if (!taskList || !preview || !dateInput || !nameInput || !whatsappLink) {
            return;
        }

        const officeWhatsApp = '918606012194';
        const storageKey = 'admin-work-report-composer-v1';
        let reportType = 'plan';
        let planTasks = [];
        let reportCompleted = [];
        let reportExtras = [];
        let planFingerprint = '';
        let historyCache = Array.isArray(workReportBootstrap?.history) ? [...workReportBootstrap.history] : [];
        const bulletByType = {
            plan: '→',
            report: '●',
        };
        const iconByType = {
            plan: 'fa-solid fa-arrow-right',
            report: 'fa-solid fa-circle',
        };

        function tasksFingerprint(tasks) {
            return (Array.isArray(tasks) ? tasks : []).map((item) => String(item || '').trim()).filter(Boolean).join('\n');
        }

        function formatDisplayDate(value) {
            if (!value || !/^\d{4}-\d{2}-\d{2}$/.test(value)) {
                const now = new Date();
                const dd = String(now.getDate()).padStart(2, '0');
                const mm = String(now.getMonth() + 1).padStart(2, '0');
                const yyyy = now.getFullYear();
                return `${dd}/${mm}/${yyyy}`;
            }
            const [y, m, d] = value.split('-');
            return `${d}/${m}/${y}`;
        }

        function titleForType() {
            return reportType === 'report' ? "Today's Work Report" : "Today's Work Plan";
        }

        function activeBullet() {
            return bulletByType[reportType] || '→';
        }

        function activeIcon() {
            return iconByType[reportType] || iconByType.plan;
        }

        function toCompletedSentence(raw) {
            const text = String(raw || '').trim();
            if (!text) {
                return '';
            }

            if (/^(completed|finished|done|fixed|prepared|created|updated|added|implemented|built|worked|reviewed|designed|developed|checked|tested|deployed|wrote|made|did|set up|resolved|improved|optimized|refactored|integrated|configured|documented)\b/i.test(text)) {
                return text.charAt(0).toUpperCase() + text.slice(1);
            }

            const rules = [
                [/^fix(es|ing)?\b/i, 'Fixed'],
                [/^prepare(d|s|ing)?\b/i, 'Prepared'],
                [/^create(d|s|ing)?\b/i, 'Created'],
                [/^update(d|s|ing)?\b/i, 'Updated'],
                [/^add(ed|s|ing)?\b/i, 'Added'],
                [/^implement(ed|s|ing)?\b/i, 'Implemented'],
                [/^build(ing)?\b/i, 'Built'],
                [/^built\b/i, 'Built'],
                [/^work(ed|s|ing)? on\b/i, 'Worked on'],
                [/^work(ed|s|ing)?\b/i, 'Worked on'],
                [/^review(ed|s|ing)?\b/i, 'Reviewed'],
                [/^design(ed|s|ing)?\b/i, 'Designed'],
                [/^develop(ed|s|ing)?\b/i, 'Developed'],
                [/^check(ed|s|ing)?\b/i, 'Checked'],
                [/^test(ed|s|ing)?\b/i, 'Tested'],
                [/^deploy(ed|s|ing)?\b/i, 'Deployed'],
                [/^write\b/i, 'Wrote'],
                [/^wrote\b/i, 'Wrote'],
                [/^make\b/i, 'Made'],
                [/^made\b/i, 'Made'],
                [/^do\b/i, 'Did'],
                [/^did\b/i, 'Did'],
                [/^set[\s-]?up\b/i, 'Set up'],
                [/^setup\b/i, 'Set up'],
                [/^resolve(d|s|ing)?\b/i, 'Resolved'],
                [/^improve(d|s|ing)?\b/i, 'Improved'],
                [/^optimiz(e|ed|es|ing)\b/i, 'Optimized'],
                [/^refactor(ed|s|ing)?\b/i, 'Refactored'],
                [/^integrat(e|ed|es|ing)\b/i, 'Integrated'],
                [/^configur(e|ed|es|ing)\b/i, 'Configured'],
                [/^document(ed|s|ing)?\b/i, 'Documented'],
                [/^complete(d|s|ing)?\b/i, 'Completed'],
                [/^finish(ed|es|ing)?\b/i, 'Finished'],
                [/^start(ed|s|ing)?\b/i, 'Started'],
                [/^plan(ned|s|ning)?\b/i, 'Planned'],
                [/^debug(ged|s|ging)?\b/i, 'Debugged'],
                [/^research(ed|es|ing)?\b/i, 'Researched'],
            ];

            for (const [pattern, replacement] of rules) {
                if (pattern.test(text)) {
                    return text.replace(pattern, replacement);
                }
            }

            const rest = text.charAt(0).toLowerCase() + text.slice(1);
            return `Completed ${rest}`;
        }

        function getTasks() {
            return Array.from(taskList.querySelectorAll('[data-work-report-task]'))
                .map((input) => String(input.value || '').trim())
                .filter(Boolean);
        }

        function getExtraTasksFromDom() {
            return Array.from(taskList.querySelectorAll('.work-report-task-row'))
                .filter((row) => row.dataset.fromPlan !== '1')
                .map((row) => row.querySelector('[data-work-report-task]'))
                .map((input) => String(input?.value || '').trim())
                .filter(Boolean);
        }

        function getCompletedTasksFromDom() {
            return Array.from(taskList.querySelectorAll('.work-report-task-row'))
                .filter((row) => row.dataset.fromPlan === '1')
                .map((row) => row.querySelector('[data-work-report-task]'))
                .map((input) => String(input?.value || '').trim())
                .filter(Boolean);
        }

        function ensureReportCompletedFromPlan(force = false) {
            const nextFingerprint = tasksFingerprint(planTasks);
            if (force || nextFingerprint !== planFingerprint || !reportCompleted.length) {
                reportCompleted = planTasks.map(toCompletedSentence).filter(Boolean);
                planFingerprint = nextFingerprint;
            }
        }

        function showSaveStatus(message, isError = false) {
            if (!saveStatus) {
                return;
            }
            saveStatus.textContent = message;
            saveStatus.classList.remove('hidden');
            saveStatus.classList.toggle('text-rose-700', isError);
            saveStatus.classList.toggle('text-emerald-700', !isError);
            window.setTimeout(() => {
                saveStatus.classList.add('hidden');
            }, 2500);
        }

        function findHistoryEntry(date, type) {
            return historyCache.find((entry) => entry.report_date === date && entry.entry_type === type) || null;
        }

        function upsertHistoryCache(entry) {
            if (!entry?.report_date || !entry?.entry_type) {
                return;
            }
            const idx = historyCache.findIndex((item) => item.report_date === entry.report_date && item.entry_type === entry.entry_type);
            if (idx >= 0) {
                historyCache[idx] = { ...historyCache[idx], ...entry };
            } else {
                historyCache.unshift(entry);
            }
            historyCache.sort((a, b) => String(b.report_date).localeCompare(String(a.report_date)));
            renderHistoryList();
        }

        function renderHistoryList() {
            const list = document.getElementById('workReportHistoryList');
            if (!list) {
                return;
            }
            if (!historyCache.length) {
                list.innerHTML = '<p class="text-xs text-slate-500">No saved plans/reports yet. Save today’s plan to start history.</p>';
                return;
            }
            list.innerHTML = historyCache.map((entry) => {
                const previewText = [...(entry.tasks || []), ...(entry.extra_tasks || [])].filter(Boolean).slice(0, 2).join(' · ') || 'Empty entry';
                const dateLabel = formatDisplayDate(entry.report_date);
                const typeClass = entry.entry_type === 'report' ? 'text-amber-300' : 'text-emerald-700';
                return `
                    <button
                        type="button"
                        class="work-history-item w-full text-left rounded-lg border border-slate-200 px-3 py-2"
                        data-work-history-date="${entry.report_date}"
                        data-work-history-type="${entry.entry_type}"
                    >
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-xs font-semibold">${dateLabel}</span>
                            <span class="text-[10px] uppercase tracking-wide ${typeClass}">${entry.entry_type}</span>
                        </div>
                        <p class="text-[11px] text-slate-500 mt-1 truncate">${previewText.replace(/</g, '&lt;')}</p>
                    </button>
                `;
            }).join('');

            list.querySelectorAll('.work-history-item').forEach((button) => {
                button.addEventListener('click', () => {
                    const date = button.dataset.workHistoryDate;
                    const type = button.dataset.workHistoryType === 'report' ? 'report' : 'plan';
                    loadEntryForDate(date, type);
                    list.querySelectorAll('.work-history-item').forEach((item) => item.classList.remove('is-active'));
                    button.classList.add('is-active');
                });
            });
        }

        function applyEntryToState(entry, type) {
            if (!entry) {
                if (type === 'plan') {
                    planTasks = [];
                } else {
                    reportCompleted = [];
                    reportExtras = [];
                    planFingerprint = '';
                }
                return;
            }
            if (entry.employee_name) {
                nameInput.value = entry.employee_name;
            }
            if (type === 'plan') {
                planTasks = (entry.tasks || []).map((item) => String(item || '').trim()).filter(Boolean);
            } else {
                reportCompleted = (entry.tasks || []).map((item) => String(item || '').trim()).filter(Boolean);
                reportExtras = (entry.extra_tasks || []).map((item) => String(item || '').trim()).filter(Boolean);
                planFingerprint = tasksFingerprint(planTasks);
            }
        }

        function loadEntryForDate(date, type = 'plan') {
            dateInput.value = date;
            const weekFormDate = document.getElementById('workWeekFormDate');
            const monthFormDate = document.getElementById('workMonthFormDate');
            if (weekFormDate) weekFormDate.value = date;
            if (monthFormDate) monthFormDate.value = date;

            const planEntry = findHistoryEntry(date, 'plan');
            const reportEntry = findHistoryEntry(date, 'report');
            applyEntryToState(planEntry, 'plan');
            applyEntryToState(reportEntry, 'report');

            if (!planEntry && !reportEntry) {
                // Keep current draft if switching to empty date? Prefer clean load for selected date.
                if (type === 'plan') {
                    planTasks = [];
                }
                if (!reportEntry) {
                    reportCompleted = [];
                    reportExtras = [];
                    planFingerprint = '';
                }
            }

            reportType = type;
            if (type === 'report' && !reportEntry && planTasks.length) {
                ensureReportCompletedFromPlan(true);
            }
            renderCurrentType();
        }

        function loadFromServerBootstrap() {
            const bootDate = workReportBootstrap?.date || dateInput.value;
            dateInput.value = bootDate;
            const plan = workReportBootstrap?.plan || {};
            const report = workReportBootstrap?.report || {};
            if (Array.isArray(plan.tasks) && plan.tasks.length) {
                planTasks = plan.tasks.map((item) => String(item || '').trim()).filter(Boolean);
            }
            if (plan.employee_name) {
                nameInput.value = plan.employee_name;
            }
            if (Array.isArray(report.tasks) && report.tasks.length) {
                reportCompleted = report.tasks.map((item) => String(item || '').trim()).filter(Boolean);
                reportExtras = (report.extra_tasks || []).map((item) => String(item || '').trim()).filter(Boolean);
                planFingerprint = tasksFingerprint(planTasks);
            }
            if (report.employee_name && !plan.employee_name) {
                nameInput.value = report.employee_name;
            }
            if (reportCompleted.length || reportExtras.length) {
                reportType = 'report';
            } else {
                reportType = 'plan';
            }
        }

        function persistState() {
            try {
                sessionStorage.setItem(storageKey, JSON.stringify({
                    type: reportType,
                    date: dateInput.value,
                    name: nameInput.value,
                    planTasks,
                    reportCompleted,
                    reportExtras,
                    planFingerprint,
                }));
            } catch (error) {
                // Ignore storage failures.
            }
        }

        function restoreState() {
            // Server data wins for the selected work date; sessionStorage is draft fallback only.
            const hasServerPlan = Array.isArray(workReportBootstrap?.plan?.tasks) && workReportBootstrap.plan.tasks.length > 0;
            const hasServerReport = Array.isArray(workReportBootstrap?.report?.tasks) && workReportBootstrap.report.tasks.length > 0;
            if (hasServerPlan || hasServerReport) {
                loadFromServerBootstrap();
                return;
            }
            try {
                const raw = sessionStorage.getItem(storageKey);
                if (!raw) {
                    return;
                }
                const saved = JSON.parse(raw);
                if (!saved || typeof saved !== 'object') {
                    return;
                }
                if (saved.date && saved.date !== dateInput.value) {
                    return;
                }
                if (Array.isArray(saved.planTasks)) {
                    planTasks = saved.planTasks.map((item) => String(item || '').trim()).filter(Boolean);
                }
                if (Array.isArray(saved.reportCompleted)) {
                    reportCompleted = saved.reportCompleted.map((item) => String(item || '').trim()).filter(Boolean);
                }
                if (Array.isArray(saved.reportExtras)) {
                    reportExtras = saved.reportExtras.map((item) => String(item || '').trim()).filter(Boolean);
                }
                if (typeof saved.planFingerprint === 'string') {
                    planFingerprint = saved.planFingerprint;
                }
                if (saved.name) {
                    nameInput.value = saved.name;
                }
                if (saved.type === 'report' || saved.type === 'plan') {
                    reportType = saved.type;
                }
            } catch (error) {
                // Ignore storage failures.
            }
        }

        function syncLabels() {
            if (tasksLabel) {
                tasksLabel.textContent = reportType === 'report' ? 'Completed tasks (+ extras)' : 'Plan tasks';
            }
            if (addTaskLabel) {
                addTaskLabel.textContent = reportType === 'report' ? 'Add extra task' : 'Add task';
            }
            if (saveLabel) {
                saveLabel.textContent = reportType === 'report' ? 'Save report' : 'Save plan';
            }
            if (hintEl) {
                hintEl.textContent = reportType === 'report'
                    ? 'Auto-filled from your plan as completed lines. Edit if needed, add extras, then Save report.'
                    : 'Write morning plan with →. Switch to Report to auto-convert into completed ● lines. Save to keep forever.';
            }
            typeButtons.forEach((btn) => {
                btn.classList.toggle('is-active', btn.dataset.workReportType === reportType);
            });
        }

        async function saveCurrentEntry() {
            refreshPreview();
            const payload = {
                report_date: dateInput.value,
                entry_type: reportType,
                employee_name: String(nameInput.value || 'Arjun Kumar H').trim() || 'Arjun Kumar H',
                tasks: reportType === 'plan' ? planTasks : reportCompleted,
                extra_tasks: reportType === 'report' ? reportExtras : [],
                message_snapshot: buildMessage(),
            };
            if (saveBtn) {
                saveBtn.disabled = true;
            }
            try {
                const response = await fetch(workReportSaveUrl, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify(payload),
                });
                const data = await response.json();
                if (!response.ok) {
                    throw new Error(data?.message || 'Save failed');
                }
                if (data.entry) {
                    upsertHistoryCache(data.entry);
                }
                showSaveStatus(data.message || 'Saved.');
            } catch (error) {
                showSaveStatus(error?.message || 'Could not save. Try again.', true);
            } finally {
                if (saveBtn) {
                    saveBtn.disabled = false;
                }
            }
        }

        function buildMessage() {
            const lines = [
                titleForType(),
                formatDisplayDate(dateInput.value),
                String(nameInput.value || 'Arjun Kumar H').trim() || 'Arjun Kumar H',
                '',
            ];
            const tasks = getTasks();
            const bullet = activeBullet();
            if (!tasks.length) {
                lines.push(`${bullet} `);
            } else {
                tasks.forEach((task) => {
                    lines.push(`${bullet} ${task}`);
                });
            }
            return lines.join('\n');
        }

        function refreshPreview() {
            const message = buildMessage();
            preview.textContent = message;
            whatsappLink.href = `https://wa.me/${officeWhatsApp}?text=${encodeURIComponent(message)}`;
            restyleTaskBullets();
            if (reportType === 'plan') {
                planTasks = getTasks();
            } else {
                reportCompleted = getCompletedTasksFromDom();
                reportExtras = getExtraTasksFromDom();
            }
            persistState();
        }

        function restyleTaskBullets() {
            const icon = activeIcon();
            taskList.querySelectorAll('.work-report-task-row').forEach((row, index) => {
                const badge = row.querySelector('.work-report-task-num');
                if (badge) {
                    badge.innerHTML = `<i class="${icon}" aria-hidden="true"></i>`;
                    badge.title = row.dataset.fromPlan === '1' ? `From plan #${index + 1}` : `Task ${index + 1}`;
                    badge.dataset.bulletStyle = reportType;
                }
            });
        }

        function addTaskRow(value = '', options = {}) {
            const fromPlan = Boolean(options.fromPlan);
            const row = document.createElement('div');
            row.className = 'work-report-task-row';
            if (fromPlan) {
                row.dataset.fromPlan = '1';
            }
            const placeholder = reportType === 'report'
                ? (fromPlan ? 'Completed task from plan...' : 'Extra completed task...')
                : 'Describe the task...';
            row.innerHTML = `
                <span class="work-report-task-num" aria-hidden="true"><i class="${activeIcon()}"></i></span>
                <input type="text" data-work-report-task class="soft-input rounded-lg px-3 py-2 text-sm" placeholder="${placeholder}" value="">
                <button type="button" class="card-action-btn card-action-btn-danger" data-remove-task title="Remove" aria-label="Remove">
                    <i class="fa-solid fa-trash text-[10px]"></i>
                </button>
            `;
            const input = row.querySelector('[data-work-report-task]');
            if (input) {
                input.value = value;
                input.addEventListener('input', refreshPreview);
                input.addEventListener('keydown', (event) => {
                    if (event.key === 'Enter') {
                        event.preventDefault();
                        addTaskRow('', { fromPlan: false });
                        const inputs = taskList.querySelectorAll('[data-work-report-task]');
                        inputs[inputs.length - 1]?.focus();
                    }
                });
            }
            row.querySelector('[data-remove-task]')?.addEventListener('click', () => {
                row.remove();
                if (!taskList.querySelector('.work-report-task-row')) {
                    addTaskRow('', { fromPlan: false });
                }
                refreshPreview();
            });
            taskList.appendChild(row);
            refreshPreview();
            return input;
        }

        function renderTaskList(tasks, options = {}) {
            const fromPlan = Boolean(options.fromPlan);
            taskList.innerHTML = '';
            const list = Array.isArray(tasks) ? tasks.filter((item) => String(item || '').trim()) : [];
            if (!list.length) {
                addTaskRow('', { fromPlan: false });
                return;
            }
            list.forEach((task) => addTaskRow(task, { fromPlan }));
        }

        function renderCurrentType() {
            syncLabels();
            if (reportType === 'plan') {
                renderTaskList(planTasks, { fromPlan: false });
            } else {
                ensureReportCompletedFromPlan(false);
                taskList.innerHTML = '';
                reportCompleted.forEach((task) => addTaskRow(task, { fromPlan: true }));
                reportExtras.forEach((task) => addTaskRow(task, { fromPlan: false }));
                if (!reportCompleted.length && !reportExtras.length) {
                    addTaskRow('', { fromPlan: false });
                }
            }
            refreshPreview();
        }

        function switchType(nextType) {
            const next = nextType === 'report' ? 'report' : 'plan';
            if (next === reportType) {
                return;
            }
            if (reportType === 'plan') {
                planTasks = getTasks();
            } else {
                reportCompleted = getCompletedTasksFromDom();
                reportExtras = getExtraTasksFromDom();
            }
            reportType = next;
            renderCurrentType();
        }

        typeButtons.forEach((button) => {
            button.addEventListener('click', () => {
                switchType(button.dataset.workReportType === 'report' ? 'report' : 'plan');
            });
        });

        addBtn?.addEventListener('click', () => {
            const input = addTaskRow('', { fromPlan: false });
            input?.focus();
        });
        saveBtn?.addEventListener('click', () => {
            saveCurrentEntry();
        });
        clearBtn?.addEventListener('click', () => {
            taskList.innerHTML = '';
            addTaskRow('', { fromPlan: false });
            if (reportType === 'plan') {
                planTasks = [];
                reportCompleted = [];
                planFingerprint = '';
            } else {
                reportCompleted = [];
                reportExtras = [];
                planFingerprint = '';
            }
            refreshPreview();
        });
        sampleBtn?.addEventListener('click', () => {
            reportType = 'plan';
            planTasks = [
                'E-commerce website our products and profile page layout and UI',
                'Fix checkout flow and mobile responsiveness',
                'Prepare daily status update for review',
            ];
            reportCompleted = [];
            reportExtras = [];
            planFingerprint = '';
            renderCurrentType();
        });
        copyBtn?.addEventListener('click', async () => {
            const message = buildMessage();
            try {
                await navigator.clipboard.writeText(message);
                copyBtn.textContent = 'Copied';
                window.setTimeout(() => {
                    copyBtn.innerHTML = '<i class="fa-regular fa-copy text-xs"></i> Copy message';
                }, 1200);
            } catch (error) {
                window.prompt('Copy this message:', message);
            }
        });
        document.querySelectorAll('[data-copy-target]').forEach((button) => {
            button.addEventListener('click', async () => {
                const targetId = button.getAttribute('data-copy-target');
                const target = targetId ? document.getElementById(targetId) : null;
                const message = target?.textContent || '';
                if (!message.trim()) {
                    return;
                }
                try {
                    await navigator.clipboard.writeText(message);
                    const original = button.innerHTML;
                    button.textContent = 'Copied';
                    window.setTimeout(() => {
                        button.innerHTML = original;
                    }, 1200);
                } catch (error) {
                    window.prompt('Copy this message:', message);
                }
            });
        });
        dateInput.addEventListener('change', () => {
            const date = dateInput.value;
            const planEntry = findHistoryEntry(date, 'plan');
            const reportEntry = findHistoryEntry(date, 'report');
            if (planEntry || reportEntry) {
                loadEntryForDate(date, reportEntry ? 'report' : 'plan');
            } else {
                planTasks = [];
                reportCompleted = [];
                reportExtras = [];
                planFingerprint = '';
                reportType = 'plan';
                renderCurrentType();
            }
        });
        nameInput.addEventListener('input', refreshPreview);

        // Prefer history buttons already in DOM from Blade on first paint.
        document.querySelectorAll('#workReportHistoryList .work-history-item').forEach((button) => {
            button.addEventListener('click', () => {
                const date = button.dataset.workHistoryDate;
                const type = button.dataset.workHistoryType === 'report' ? 'report' : 'plan';
                const tasksRaw = button.getAttribute('data-work-history-tasks');
                const extrasRaw = button.getAttribute('data-work-history-extras');
                const name = button.getAttribute('data-work-history-name') || '';
                try {
                    const tasks = JSON.parse(tasksRaw || '[]');
                    const extras = JSON.parse(extrasRaw || '[]');
                    upsertHistoryCache({
                        id: Number(button.dataset.workHistoryId || 0),
                        report_date: date,
                        entry_type: type,
                        employee_name: name,
                        tasks,
                        extra_tasks: extras,
                    });
                } catch (error) {
                    // ignore parse errors
                }
                loadEntryForDate(date, type);
                document.querySelectorAll('#workReportHistoryList .work-history-item').forEach((item) => item.classList.remove('is-active'));
                button.classList.add('is-active');
            });
        });

        restoreState();
        renderCurrentType();
    }
    bindDashboardPanelCards();
    if (hasValidationErrors) {
        window.requestAnimationFrame(() => {
            window.scrollTo({ top: 0, behavior: 'auto' });
        });
        if (oldWeightContext) {
            setActiveDashboardPanel('fitness');
        } else if (openExpenseCreateOnError || openIncomeCreateOnError) {
            setActiveDashboardPanel('money');
        } else {
            setActiveDashboardPanel('goal');
        }
    } else if (dashboardReturnState?.panel) {
        setActiveDashboardPanel(dashboardReturnState.panel);
        scheduleDashboardScrollRestore(dashboardReturnState.y);
    } else {
        const storedPanel = sessionStorage.getItem(dashboardPanelStorageKey);
        const urlParams = new URLSearchParams(window.location.search);
        const openWorkFromQuery = urlParams.has('work_week_start') || urlParams.has('work_month') || urlParams.has('work_year') || urlParams.has('work_date');
        if (openWorkFromQuery) {
            setActiveDashboardPanel('work');
        } else if (storedPanel === 'money' || storedPanel === 'fitness' || storedPanel === 'goal' || storedPanel === 'work') {
            setActiveDashboardPanel(storedPanel);
        }
    }
    if (openExpenseCreateOnError) {
        openModalById('expenseCreateModal');
    } else if (openIncomeCreateOnError) {
        openModalById('incomeCreateModal');
    }

    let todos = (Array.isArray(initialTodos) ? initialTodos : []).map((todo) => ({
        id: todo.id ?? `${Date.now()}-${Math.random().toString(36).slice(2, 8)}`,
        title: todo.title ?? '',
        status: ['incomplete', 'completed', 'dropped'].includes(todo.status)
            ? todo.status
            : (todo.done ? 'completed' : 'incomplete'),
        pinned: Boolean(todo.pinned),
        dueDate: typeof todo.dueDate === 'string' ? todo.dueDate : '',
        createdAt: typeof todo.createdAt === 'number' ? todo.createdAt : Date.now(),
        order: typeof todo.order === 'number' ? todo.order : Date.now(),
    }));

    let shouldSyncMigratedTodos = false;
    const legacyTodos = JSON.parse(localStorage.getItem(todoKey) || '[]');
    if (!todos.length && Array.isArray(legacyTodos) && legacyTodos.length) {
        todos = legacyTodos.map((todo) => ({
            id: todo.id ?? `${Date.now()}-${Math.random().toString(36).slice(2, 8)}`,
            title: todo.title ?? '',
            status: ['incomplete', 'completed', 'dropped'].includes(todo.status)
                ? todo.status
                : (todo.done ? 'completed' : 'incomplete'),
            pinned: Boolean(todo.pinned),
            dueDate: typeof todo.dueDate === 'string' ? todo.dueDate : '',
            createdAt: typeof todo.createdAt === 'number' ? todo.createdAt : Date.now(),
            order: typeof todo.order === 'number' ? todo.order : Date.now(),
        }));
        localStorage.removeItem(todoKey);
        shouldSyncMigratedTodos = true;
    }

    let todoSyncTimer = null;

    function sanitizeTodoForSync(todo, index) {
        const rawTitle = String(todo?.title ?? '').trim();
        const title = rawTitle ? rawTitle.slice(0, 150) : 'Untitled task';
        const rawDueDate = typeof todo?.dueDate === 'string' ? todo.dueDate.trim() : '';
        const dueDate = /^\d{4}-\d{2}-\d{2}$/.test(rawDueDate) ? rawDueDate : null;

        return {
            title,
            status: ['incomplete', 'completed', 'dropped'].includes(todo?.status) ? todo.status : 'incomplete',
            pinned: Boolean(todo?.pinned),
            dueDate,
            createdAt: Number.isFinite(todo?.createdAt) ? Number(todo.createdAt) : Date.now(),
            order: Number.isFinite(todo?.order) ? Number(todo.order) : (index + 1),
        };
    }

    async function syncTodosToServer() {
        const normalizedTodos = todos
            .map((todo, index) => sanitizeTodoForSync(todo, index))
            .sort((a, b) => {
                const aOrder = Number.isFinite(a.order) ? a.order : 0;
                const bOrder = Number.isFinite(b.order) ? b.order : 0;
                if (aOrder !== bOrder) {
                    return aOrder - bOrder;
                }
                return a.createdAt - b.createdAt;
            })
            .map((todo, index) => ({
                ...todo,
                order: index + 1,
            }));

        const payload = {
            todos: normalizedTodos,
        };

        const response = await fetch(todoSyncUrl, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            credentials: 'same-origin',
            body: JSON.stringify(payload),
        });

        if (!response.ok) {
            const bodyText = await response.text();
            throw new Error(`Todo sync failed (${response.status}): ${bodyText.slice(0, 220)}`);
        }

        let data = null;
        try {
            data = await response.json();
        } catch (_error) {
            throw new Error('Todo sync response was not valid JSON.');
        }
        if (Array.isArray(data.todos)) {
            todos = data.todos.map((todo) => ({
                id: todo.id ?? `${Date.now()}-${Math.random().toString(36).slice(2, 8)}`,
                title: todo.title ?? '',
                status: ['incomplete', 'completed', 'dropped'].includes(todo.status) ? todo.status : 'incomplete',
                pinned: Boolean(todo.pinned),
                dueDate: typeof todo.dueDate === 'string' ? todo.dueDate : '',
                createdAt: typeof todo.createdAt === 'number' ? todo.createdAt : Date.now(),
                order: typeof todo.order === 'number' ? todo.order : Date.now(),
            }));
        }
    }

    function saveTodos() {
        if (todoSyncTimer) {
            window.clearTimeout(todoSyncTimer);
        }
        todoSyncTimer = window.setTimeout(() => {
            syncTodosToServer().catch((error) => {
                const message = error instanceof Error ? error.message : 'Unknown sync error';
                window.alert(`Unable to sync todos right now. ${message}`);
            });
        }, 180);
    }

    function getTodoPriority(dueDate) {
        if (!dueDate) {
            return { key: 'none', label: 'No date' };
        }

        const today = new Date();
        today.setHours(0, 0, 0, 0);
        const due = new Date(`${dueDate}T00:00:00`);
        const diffDays = Math.floor((due.getTime() - today.getTime()) / 86400000);

        if (diffDays < 0) {
            return { key: 'overdue', label: 'Overdue' };
        }
        if (diffDays === 0) {
            return { key: 'today', label: 'Today' };
        }
        if (diffDays <= 7) {
            return { key: 'soon', label: 'Upcoming (1 week)' };
        }
        if (diffDays <= 14) {
            return { key: 'mid', label: 'Upcoming (8-14 days)' };
        }
        return { key: 'far', label: 'Upcoming (15+ days)' };
    }

    function formatDueDate(dueDate) {
        if (!dueDate) {
            return 'No due date';
        }
        const date = new Date(`${dueDate}T00:00:00`);
        return date.toLocaleDateString(undefined, { year: 'numeric', month: 'short', day: 'numeric' });
    }

    function getDaysFromToday(dueDate) {
        if (!dueDate) {
            return null;
        }
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        const due = new Date(`${dueDate}T00:00:00`);
        return Math.floor((due.getTime() - today.getTime()) / 86400000);
    }

    function escapeHtml(value) {
        return String(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;');
    }

    function getSortedTodos() {
        const filterBy = todoFilterBy?.value || 'all';
        const sortBy = todoSortBy?.value || 'due_date';
        const sortOrder = todoSortOrder?.value || 'asc';
        const direction = sortOrder === 'desc' ? -1 : 1;
        const mapped = todos
            .map((todo, index) => ({ ...todo, originalIndex: index }))
            .filter((todo) => {
                const days = getDaysFromToday(todo.dueDate);
                switch (filterBy) {
                    case 'incomplete':
                        return todo.status === 'incomplete';
                    case 'completed':
                        return todo.status === 'completed';
                    case 'dropped':
                        return todo.status === 'dropped';
                    case 'pinned':
                        return todo.pinned;
                    case 'overdue':
                        return days !== null && days < 0;
                    case 'today':
                        return days === 0;
                    case 'week':
                        return days !== null && days >= 1 && days <= 7;
                    case 'next14':
                        return days !== null && days >= 8 && days <= 14;
                    case 'later':
                        return days !== null && days >= 15;
                    case 'no_date':
                        return !todo.dueDate;
                    default:
                        return true;
                }
            });

        const pinComparator = (a, b) => Number(b.pinned) - Number(a.pinned);

        if (sortBy === 'manual') {
            return mapped.sort((a, b) => {
                const pinDiff = pinComparator(a, b);
                if (pinDiff !== 0) {
                    return pinDiff;
                }
                return a.order - b.order;
            });
        }

        if (sortBy === 'created') {
            return mapped.sort((a, b) => {
                const pinDiff = pinComparator(a, b);
                if (pinDiff !== 0) {
                    return pinDiff;
                }
                return (a.createdAt - b.createdAt) * direction;
            });
        }

        return mapped.sort((a, b) => {
            const pinDiff = pinComparator(a, b);
            if (pinDiff !== 0) {
                return pinDiff;
            }
            const aHasDate = Boolean(a.dueDate);
            const bHasDate = Boolean(b.dueDate);
            if (aHasDate && bHasDate) {
                const aTime = new Date(`${a.dueDate}T00:00:00`).getTime();
                const bTime = new Date(`${b.dueDate}T00:00:00`).getTime();
                if (aTime !== bTime) {
                    return (aTime - bTime) * direction;
                }
                return (a.createdAt - b.createdAt) * direction;
            }
            if (!aHasDate && !bHasDate) {
                return (a.createdAt - b.createdAt) * direction;
            }
            return aHasDate ? -1 : 1;
        });
    }

    function buildTodoItemHtml(todo, previousDatedTask, isArchiveItem = false) {
        const priority = getTodoPriority(todo.dueDate);
        const showPriorityBadge = !['soon', 'mid', 'far'].includes(priority.key);
        const statusLabel = todo.status === 'completed'
            ? 'Completed'
            : (todo.status === 'dropped' ? 'Dropped' : 'Incomplete');
        const statusClass = todo.status === 'completed'
            ? 'todo-chip-completed'
            : (todo.status === 'dropped' ? 'todo-chip-dropped' : 'todo-chip-incomplete');
        const dueDiffDays = getDaysFromToday(todo.dueDate);
        const remainingLabel = dueDiffDays === null
            ? 'No due date'
            : dueDiffDays < 0
                ? `${Math.abs(dueDiffDays)} day(s) overdue`
                : dueDiffDays === 0
                    ? 'Due today'
                    : `${dueDiffDays} day(s) left`;
        let gapLabel = 'Gap: n/a';
        let nextPrevious = previousDatedTask;
        if (todo.dueDate) {
            if (!previousDatedTask) {
                gapLabel = 'Gap: first dated task';
            } else {
                const currentTime = new Date(`${todo.dueDate}T00:00:00`).getTime();
                const previousTime = new Date(`${previousDatedTask.dueDate}T00:00:00`).getTime();
                const gapDays = Math.round(Math.abs(currentTime - previousTime) / 86400000);
                gapLabel = `Gap: ${gapDays} day(s)`;
            }
            nextPrevious = todo;
        }
        const actionIcons = isArchiveItem
            ? `
                <button class="todo-status-icon-btn status-incomplete" data-index="${todo.originalIndex}" data-type="set-incomplete" title="Mark Incomplete"><i class="fa-regular fa-circle text-[10px]"></i></button>
                <button class="todo-status-icon-btn status-completed" data-index="${todo.originalIndex}" data-type="set-completed" title="Mark Completed"><i class="fa-solid fa-check text-[10px]"></i></button>
                <button class="todo-status-icon-btn status-dropped" data-index="${todo.originalIndex}" data-type="set-dropped" title="Mark Dropped"><i class="fa-solid fa-xmark text-[10px]"></i></button>
            `
            : `
                <button class="todo-status-icon-btn status-completed" data-index="${todo.originalIndex}" data-type="set-completed" title="Mark Completed"><i class="fa-solid fa-check text-[10px]"></i></button>
                <button class="todo-status-icon-btn status-dropped" data-index="${todo.originalIndex}" data-type="set-dropped" title="Mark Dropped"><i class="fa-solid fa-xmark text-[10px]"></i></button>
            `;

        return {
            html: `
                <div class="flex-1 min-w-0">
                    <label class="flex items-center gap-2 text-sm">
                        <span class="${
                            todo.status === 'completed'
                                ? 'line-through text-slate-400'
                                : (todo.status === 'dropped' ? 'line-through text-rose-400' : 'text-slate-700')
                        }">${escapeHtml(todo.title)}</span>
                    </label>
                    <div class="mt-1 ml-6 flex flex-wrap items-center gap-2">
                        <span class="text-xs text-slate-500">${formatDueDate(todo.dueDate)}</span>
                        <span class="todo-priority-chip ${statusClass}">${statusLabel}</span>
                        ${showPriorityBadge ? `<span class="todo-priority-chip todo-chip-${priority.key}">${priority.label}</span>` : ''}
                        <span class="todo-meta-chip">${remainingLabel}</span>
                        <span class="todo-meta-chip">${gapLabel}</span>
                    </div>
                </div>
                <div class="flex items-center gap-2 ml-2">
                    ${actionIcons}
                    <button class="todo-pin-btn ${todo.pinned ? 'is-pinned' : ''}" data-index="${todo.originalIndex}" data-type="pin" title="${todo.pinned ? 'Unpin task' : 'Pin task'}">
                        <i class="fa-solid fa-thumbtack text-[10px]"></i>
                    </button>
                    <button class="todo-action-btn" data-index="${todo.originalIndex}" data-type="edit" title="Edit" aria-label="Edit"><i class="fa-solid fa-pen-to-square text-[10px]"></i></button>
                    <button class="todo-action-btn todo-action-btn-danger" data-index="${todo.originalIndex}" data-type="delete" title="Delete" aria-label="Delete"><i class="fa-solid fa-trash text-[10px]"></i></button>
                </div>
            `,
            nextPrevious,
            priorityKey: priority.key,
        };
    }

    function renderTodos() {
        if (!todoList || !todoCompletedList) {
            return;
        }
        todoList.innerHTML = '';
        todoCompletedList.innerHTML = '';
        const sortedTodos = getSortedTodos();
        const isManualSort = (todoSortBy?.value || 'manual') === 'manual';
        const activeTodos = sortedTodos.filter((todo) => todo.status === 'incomplete');
        const archivedTodos = sortedTodos.filter((todo) => todo.status !== 'incomplete');

        let previousDatedTask = null;
        activeTodos.forEach((todo) => {
            const built = buildTodoItemHtml(todo, previousDatedTask, false);
            previousDatedTask = built.nextPrevious;
            const li = document.createElement('li');
            li.className = `todo-item flex items-center justify-between rounded-lg border border-slate-200 px-3 py-2 todo-priority-${built.priorityKey}`;
            li.draggable = isManualSort;
            li.dataset.draggable = isManualSort ? 'true' : 'false';
            li.dataset.index = String(todo.originalIndex);
            li.innerHTML = built.html;
            todoList.appendChild(li);
        });

        let previousArchiveDate = null;
        archivedTodos.forEach((todo) => {
            const built = buildTodoItemHtml(todo, previousArchiveDate, true);
            previousArchiveDate = built.nextPrevious;
            const li = document.createElement('li');
            li.className = `todo-item flex items-center justify-between rounded-lg border border-slate-200 px-3 py-2 todo-priority-${built.priorityKey}`;
            li.draggable = false;
            li.dataset.draggable = 'false';
            li.dataset.index = String(todo.originalIndex);
            li.innerHTML = built.html;
            todoCompletedList.appendChild(li);
        });

        if (!activeTodos.length) {
            const emptyActive = document.createElement('li');
            emptyActive.className = 'rounded-lg border border-dashed border-slate-300 bg-slate-50 px-3 py-2 text-xs text-slate-500';
            emptyActive.textContent = 'No active tasks yet. Add one above.';
            todoList.appendChild(emptyActive);
        }
        if (!archivedTodos.length) {
            const emptyArchived = document.createElement('li');
            emptyArchived.className = 'rounded-lg border border-dashed border-slate-300 bg-slate-50 px-3 py-2 text-xs text-slate-500';
            emptyArchived.textContent = 'No completed or dropped tasks yet.';
            todoCompletedList.appendChild(emptyArchived);
        }
    }

    let expensePieInstance = null;

    if (typeof Chart !== 'undefined') {
        Chart.defaults.color = '#AAB5B1';
        Chart.defaults.borderColor = 'rgba(255, 255, 255, 0.08)';
        Chart.defaults.plugins.legend.labels.color = '#AAB5B1';
    }

    function renderPieChart() {
        if (!pieChart || !pieLegend || typeof Chart === 'undefined') {
            return;
        }
        const total = categoryTotals.reduce((sum, item) => sum + Number(item.total_amount), 0);
        if (!categoryTotals.length || total <= 0) {
            if (expensePieInstance) {
                expensePieInstance.destroy();
                expensePieInstance = null;
            }
            pieLegend.innerHTML = '<p class="text-sm text-white/70 text-center">Add expense data to see chart.</p>';
            return;
        }

        if (expensePieInstance) {
            expensePieInstance.destroy();
        }

        const ctx = pieChart.getContext('2d');
        const depthColors = ['#075985', '#0f766e', '#b45309', '#be123c', '#4338ca', '#047857', '#7e22ce'];
        const slicePercents = categoryTotals.map((item) => {
            const amount = Number(item.total_amount);
            return total > 0 ? (amount / total) * 100 : 0;
        });

        const pieLabelPlugin = {
            id: 'pieCategoryLabels',
            afterDraw(chart) {
                const dataset = chart.data.datasets?.[0];
                const meta = chart.getDatasetMeta(0);
                if (!dataset || !meta?.data?.length) {
                    return;
                }

                const context = chart.ctx;
                meta.data.forEach((arc, index) => {
                    const value = Number(dataset.data[index] || 0);
                    const percent = total > 0 ? (value / total) * 100 : 0;
                    if (percent < 2.5) {
                        return;
                    }

                    const angle = arc.startAngle + (arc.endAngle - arc.startAngle) / 2;
                    const labelRadius = arc.innerRadius + (arc.outerRadius - arc.innerRadius) * 0.58;
                    const x = arc.x + Math.cos(angle) * labelRadius;
                    const y = arc.y + Math.sin(angle) * labelRadius;
                    const label = percent >= 10 ? `${percent.toFixed(0)}%` : `${percent.toFixed(1)}%`;

                    context.save();
                    context.fillStyle = '#ffffff';
                    context.font = '700 11px system-ui, -apple-system, sans-serif';
                    context.textAlign = 'center';
                    context.textBaseline = 'middle';
                    context.shadowColor = 'rgba(15, 23, 42, 0.45)';
                    context.shadowBlur = 6;
                    context.fillText(label, x, y);
                    context.restore();
                });
            },
        };

        const pieCenterPlugin = {
            id: 'pieCenterTotal',
            afterDraw(chart) {
                const meta = chart.getDatasetMeta(0);
                if (!meta?.data?.length) {
                    return;
                }

                const firstArc = meta.data[0];
                const props = firstArc.getProps(['x', 'y'], true);
                const context = chart.ctx;

                context.save();
                context.textAlign = 'center';
                context.textBaseline = 'middle';
                context.fillStyle = 'rgba(255, 255, 255, 0.78)';
                context.font = '600 10px system-ui, -apple-system, sans-serif';
                context.fillText('Total expense', props.x, props.y - 11);
                context.fillStyle = '#ffffff';
                context.font = '700 13px system-ui, -apple-system, sans-serif';
                context.fillText(`Rs ${total.toLocaleString(undefined, { maximumFractionDigits: 0 })}`, props.x, props.y + 8);
                context.restore();
            },
        };

        const shadowPlugin = {
            id: 'pieShadowDepth',
            beforeDraw(chart) {
                const dataset = chart.data.datasets?.[0];
                const meta = chart.getDatasetMeta(0);
                if (!dataset || !meta || !meta.data) {
                    return;
                }

                const context = chart.ctx;
                const slices = meta.data;
                const colors = dataset.backgroundColor || [];

                context.save();
                slices.forEach((arc, index) => {
                    const props = arc.getProps(['x', 'y', 'startAngle', 'endAngle', 'outerRadius', 'innerRadius'], true);
                    context.beginPath();
                    context.fillStyle = depthColors[index % depthColors.length] || colors[index % colors.length] || '#334155';
                    context.arc(props.x, props.y + 8, props.outerRadius, props.startAngle, props.endAngle);
                    context.arc(props.x, props.y + 8, props.innerRadius, props.endAngle, props.startAngle, true);
                    context.closePath();
                    context.globalAlpha = 0.55;
                    context.fill();
                });
                context.restore();
            },
            beforeDatasetDraw(chart) {
                const context = chart.ctx;
                context.save();
                context.shadowColor = 'rgba(15, 23, 42, 0.5)';
                context.shadowBlur = 22;
                context.shadowOffsetY = 10;
            },
            afterDatasetDraw(chart) {
                const context = chart.ctx;
                context.restore();

                // Soft top highlight makes slices appear more raised.
                const meta = chart.getDatasetMeta(0);
                if (!meta || !meta.data || meta.data.length === 0) {
                    return;
                }
                const firstArc = meta.data[0];
                const props = firstArc.getProps(['x', 'y', 'outerRadius'], true);
                const light = context.createRadialGradient(
                    props.x - props.outerRadius * 0.45,
                    props.y - props.outerRadius * 0.55,
                    8,
                    props.x,
                    props.y,
                    props.outerRadius
                );
                light.addColorStop(0, 'rgba(255, 255, 255, 0.38)');
                light.addColorStop(0.45, 'rgba(255, 255, 255, 0.12)');
                light.addColorStop(1, 'rgba(255, 255, 255, 0)');

                context.save();
                context.beginPath();
                context.arc(props.x, props.y, props.outerRadius, 0, Math.PI * 2);
                context.closePath();
                context.fillStyle = light;
                context.fill();
                context.restore();
            },
        };

        expensePieInstance = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: categoryTotals.map((item) => item.name),
                datasets: [
                    {
                        data: categoryTotals.map((item) => Number(item.total_amount)),
                        backgroundColor: categoryTotals.map((item, index) => expenseColors[index % expenseColors.length]),
                        borderColor: '#ffffff',
                        borderWidth: 2,
                        hoverOffset: 8,
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                radius: '97%',
                cutout: '52%',
                layout: {
                    padding: 8,
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            title(items) {
                                return items[0]?.label || 'Category';
                            },
                            label(context) {
                                const value = Number(context.parsed || 0);
                                const percent = total > 0 ? ((value / total) * 100).toFixed(1) : '0.0';
                                return [
                                    `Amount: Rs ${value.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`,
                                    `Share: ${percent}%`,
                                ];
                            },
                        },
                    },
                },
            },
            plugins: [shadowPlugin, pieLabelPlugin, pieCenterPlugin],
        });

        pieLegend.innerHTML = `
            <div class="pie-legend-header">
                <span>All categories</span>
                <span class="pie-legend-total">Rs ${total.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</span>
            </div>
            ${categoryTotals.map((item, index) => {
                const amount = Number(item.total_amount);
                const percent = slicePercents[index];
                const color = expenseColors[index % expenseColors.length];
                return `
                    <div class="pie-legend-item" title="${item.name}: Rs ${amount.toLocaleString()} (${percent.toFixed(1)}%)">
                        <div class="pie-legend-item-main">
                            <span class="pie-legend-dot" style="background:${color}"></span>
                            <span class="pie-legend-name">${item.name}</span>
                        </div>
                        <span class="pie-legend-stats">Rs ${amount.toLocaleString(undefined, { maximumFractionDigits: 0 })} · ${percent.toFixed(1)}%</span>
                        <div class="pie-legend-bar-wrap">
                            <span class="pie-legend-bar" style="width:${Math.max(percent, 1).toFixed(1)}%; background:${color}"></span>
                        </div>
                    </div>
                `;
            }).join('')}
        `;
    }

    if (todoForm) {
        todoForm.addEventListener('submit', (event) => {
            event.preventDefault();
            const title = todoInput.value.trim();
            if (!title) {
                return;
            }
            todos.unshift({
                id: `${Date.now()}-${Math.random().toString(36).slice(2, 8)}`,
                title,
                status: 'incomplete',
                pinned: false,
                dueDate: todoDueDate.value || '',
                createdAt: Date.now(),
                order: Date.now(),
            });
            todoInput.value = '';
            todoDueDate.value = '';
            saveTodos();
            renderTodos();
        });
    }

    function handleTodoListClick(event) {
        const actionEl = event.target.closest('[data-type]');
        if (!actionEl) {
            return;
        }
        const index = Number(actionEl.dataset.index);
        const type = actionEl.dataset.type;
        if (Number.isNaN(index) || !type) {
            return;
        }
        if (type === 'edit') {
            const current = todos[index];
            if (!current) {
                return;
            }
            const nextTitle = window.prompt('Edit task title', current.title);
            if (nextTitle === null) {
                return;
            }
            const trimmedTitle = nextTitle.trim();
            if (!trimmedTitle) {
                window.alert('Task title cannot be empty.');
                return;
            }
            const nextDueDate = window.prompt('Edit due date (YYYY-MM-DD), leave empty for none', current.dueDate || '');
            if (nextDueDate === null) {
                return;
            }
            const trimmedDueDate = nextDueDate.trim();
            if (trimmedDueDate && !/^\d{4}-\d{2}-\d{2}$/.test(trimmedDueDate)) {
                window.alert('Due date format must be YYYY-MM-DD.');
                return;
            }
            todos[index] = {
                ...current,
                title: trimmedTitle,
                dueDate: trimmedDueDate,
            };
            saveTodos();
            renderTodos();
            return;
        }
        if (type === 'pin') {
            if (!todos[index]) {
                return;
            }
            todos[index].pinned = !todos[index].pinned;
            saveTodos();
            renderTodos();
            return;
        }
        if (['set-incomplete', 'set-completed', 'set-dropped'].includes(type)) {
            if (!todos[index]) {
                return;
            }
            const statusMap = {
                'set-incomplete': 'incomplete',
                'set-completed': 'completed',
                'set-dropped': 'dropped',
            };
            todos[index].status = statusMap[type];
            saveTodos();
            renderTodos();
            return;
        }
        if (type === 'delete') {
            todos.splice(index, 1);
            saveTodos();
            renderTodos();
        }
    }

    let draggedTodoIndex = null;

    if (todoList) {
        todoList.addEventListener('click', handleTodoListClick);
        todoList.addEventListener('dragstart', (event) => {
            const target = event.target.closest('li[data-index]');
            if (!target || (todoSortBy?.value || 'manual') !== 'manual') {
                return;
            }
            draggedTodoIndex = Number(target.dataset.index);
            target.classList.add('dragging');
            event.dataTransfer.effectAllowed = 'move';
        });
        todoList.addEventListener('dragover', (event) => {
            if ((todoSortBy?.value || 'manual') !== 'manual') {
                return;
            }
            event.preventDefault();
            event.dataTransfer.dropEffect = 'move';
        });
        todoList.addEventListener('drop', (event) => {
            if ((todoSortBy?.value || 'manual') !== 'manual') {
                return;
            }
            event.preventDefault();
            const dropTarget = event.target.closest('li[data-index]');
            if (!dropTarget || draggedTodoIndex === null) {
                return;
            }
            const targetIndex = Number(dropTarget.dataset.index);
            if (Number.isNaN(targetIndex) || targetIndex === draggedTodoIndex || !todos[draggedTodoIndex] || !todos[targetIndex]) {
                return;
            }
            const movingTodo = todos[draggedTodoIndex];
            const targetTodo = todos[targetIndex];
            if (Boolean(movingTodo.pinned) !== Boolean(targetTodo.pinned)) {
                window.alert('Pin status differs. Drag inside pinned group or unpinned group.');
                return;
            }

            const sortedManual = getSortedTodos();
            const draggedPos = sortedManual.findIndex((item) => item.originalIndex === draggedTodoIndex);
            const targetPos = sortedManual.findIndex((item) => item.originalIndex === targetIndex);
            if (draggedPos < 0 || targetPos < 0) {
                return;
            }
            const [moved] = sortedManual.splice(draggedPos, 1);
            sortedManual.splice(targetPos, 0, moved);
            sortedManual.forEach((item, orderIndex) => {
                todos[item.originalIndex].order = orderIndex + 1;
            });
            saveTodos();
            renderTodos();
        });
        todoList.addEventListener('dragend', () => {
            draggedTodoIndex = null;
            todoList.querySelectorAll('.todo-item.dragging').forEach((item) => item.classList.remove('dragging'));
        });
    }
    if (todoCompletedList) {
        todoCompletedList.addEventListener('click', handleTodoListClick);
    }

    if (todoSortBy) {
        todoSortBy.addEventListener('change', () => {
            renderTodos();
        });
    }
    if (todoSortOrder) {
        todoSortOrder.addEventListener('change', () => {
            renderTodos();
        });
    }
    if (todoFilterBy) {
        todoFilterBy.addEventListener('change', () => {
            renderTodos();
        });
    }
    if (todoFilterToggle && todoFilterMenu) {
        todoFilterToggle.addEventListener('click', (event) => {
            event.stopPropagation();
            todoFilterMenu.classList.toggle('open');
        });
        document.addEventListener('click', (event) => {
            if (!todoFilterMenu.classList.contains('open')) {
                return;
            }
            if (todoFilterMenu.contains(event.target) || todoFilterToggle.contains(event.target)) {
                return;
            }
            todoFilterMenu.classList.remove('open');
        });
    }

    renderTodos();
    if (shouldSyncMigratedTodos) {
        saveTodos();
    }

    function bindMealCalorieTotals() {
        document.querySelectorAll('dialog form').forEach((form) => {
            const calorieInputs = form.querySelectorAll('.meal-calorie-input');
            const carbInputs = form.querySelectorAll('.meal-carb-input');
            const proteinInputs = form.querySelectorAll('.meal-protein-input');
            const fatInputs = form.querySelectorAll('.meal-fat-input');
            const calorieTotalInput = form.querySelector('.meal-calorie-total');
            const carbTotalInput = form.querySelector('.meal-carb-total');
            const proteinTotalInput = form.querySelector('.meal-protein-total');
            const fatTotalInput = form.querySelector('.meal-fat-total');

            if (!calorieInputs.length || !calorieTotalInput) {
                return;
            }

            const sumInputs = (inputs) => {
                let total = 0;
                inputs.forEach((input) => {
                    const value = Number(input.value || 0);
                    if (!Number.isNaN(value) && value > 0) {
                        total += value;
                    }
                });
                return total;
            };

            const updateTotal = () => {
                const calories = sumInputs(calorieInputs);
                const carbs = sumInputs(carbInputs);
                const protein = sumInputs(proteinInputs);
                const fat = sumInputs(fatInputs);

                calorieTotalInput.value = calories > 0 ? String(Math.round(calories)) : '';
                if (carbTotalInput) {
                    carbTotalInput.value = carbs > 0 ? carbs.toFixed(2) : '';
                }
                if (proteinTotalInput) {
                    proteinTotalInput.value = protein > 0 ? protein.toFixed(2) : '';
                }
                if (fatTotalInput) {
                    fatTotalInput.value = fat > 0 ? fat.toFixed(2) : '';
                }
            };
            const hasAnyMealValue = (inputs) => Array.from(inputs).some((input) => {
                const raw = String(input.value || '').trim();
                if (raw === '') {
                    return false;
                }
                const numeric = Number(raw);
                return !Number.isNaN(numeric) && numeric > 0;
            });

            [
                ...calorieInputs,
                ...carbInputs,
                ...proteinInputs,
                ...fatInputs,
            ].forEach((input) => {
                input.addEventListener('input', updateTotal);
                input.addEventListener('change', updateTotal);
            });

            if (hasAnyMealValue(calorieInputs) || hasAnyMealValue(carbInputs) || hasAnyMealValue(proteinInputs) || hasAnyMealValue(fatInputs)) {
                updateTotal();
            }
        });
    }

    bindMealCalorieTotals();

    function renderNetWorthCharts() {
        const labels = Array.isArray(netWorthMonthlyTrend?.labels) ? netWorthMonthlyTrend.labels : [];
        const monthlyNet = Array.isArray(netWorthMonthlyTrend?.monthly_net)
            ? netWorthMonthlyTrend.monthly_net.map((value) => Number(value))
            : [];
        const monthlyKinds = Array.isArray(netWorthMonthlyTrend?.monthly_kinds)
            ? netWorthMonthlyTrend.monthly_kinds
            : [];
        const cumulativeFlow = Array.isArray(netWorthMonthlyTrend?.cumulative_flow)
            ? netWorthMonthlyTrend.cumulative_flow.map((value) => Number(value))
            : [];
        const barColors = monthlyNet.map((_, i) => {
            const k = monthlyKinds[i] || 'actual';
            if (k === 'forecast') {
                return 'rgba(170, 181, 177, 0.45)';
            }
            if (k === 'blend') {
                return 'rgba(255, 201, 74, 0.72)';
            }
            return 'rgba(22, 227, 138, 0.85)';
        });

        const lineEl = document.getElementById('netWorthLineChart');
        const barEl = document.getElementById('netWorthBarChart');
        if (!lineEl || !barEl || labels.length === 0) {
            return;
        }

        new Chart(lineEl, {
            type: 'line',
            data: {
                labels,
                datasets: [
                    {
                        label: 'Cumulative (Rs)',
                        data: cumulativeFlow,
                        borderColor: '#16E38A',
                        backgroundColor: 'rgba(22,227,138,0.18)',
                        fill: true,
                        tension: 0.35,
                        pointRadius: 3,
                        pointHoverRadius: 5,
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label(ctx) {
                                const v = Number(ctx.parsed?.y ?? 0);
                                return `Rs ${v.toLocaleString()}`;
                            },
                        },
                    },
                },
                scales: {
                    x: {
                        ticks: { color: '#AAB5B1' },
                        grid: { color: 'rgba(255,255,255,0.08)' },
                    },
                    y: {
                        ticks: { color: '#AAB5B1' },
                        grid: { color: 'rgba(255,255,255,0.08)' },
                        title: { display: true, text: 'Rs (cumulative)', color: '#AAB5B1' },
                    },
                },
            },
        });

        new Chart(barEl, {
            type: 'bar',
            data: {
                labels,
                datasets: [
                    {
                        label: 'Monthly net (Rs)',
                        data: monthlyNet,
                        backgroundColor: barColors,
                        borderColor: '#16E38A',
                        borderWidth: 1.2,
                    },
                ],
            },
            options: {
                responsive: true,
                datasets: {
                    bar: {
                        borderRadius: 5,
                    },
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label(ctx) {
                                const v = Number(ctx.parsed?.y ?? 0);
                                return `Rs ${v.toLocaleString()}`;
                            },
                        },
                    },
                },
                scales: {
                    x: {
                        ticks: { color: '#AAB5B1' },
                        grid: { color: 'rgba(255,255,255,0.08)' },
                        title: { display: true, text: 'Month', color: '#AAB5B1' },
                    },
                    y: {
                        ticks: { color: '#AAB5B1' },
                        grid: { color: 'rgba(255,255,255,0.08)' },
                        title: { display: true, text: 'Rs (this month)', color: '#AAB5B1' },
                    },
                },
            },
        });
    }

    function renderWeightProgressChart() {
        const chartEl = document.getElementById('weightProgressChart');
        const goalStatusEl = document.getElementById('weightGoalStatus');
        const deltaStatusEl = document.getElementById('weightDeltaStatus');
        const labels = Array.isArray(weightTrend?.labels) ? weightTrend.labels : [];
        const series = Array.isArray(weightTrend?.weights) ? weightTrend.weights.map((value) => Number(value)) : [];
        if (!chartEl || labels.length === 0 || series.length === 0) {
            if (goalStatusEl) {
                goalStatusEl.textContent = `Goal target: ${weightGoalKg.toFixed(0)} kg`;
            }
            if (deltaStatusEl) {
                deltaStatusEl.textContent = `Vs best: +${(currentReferenceWeightKg - previousBestWeightKg).toFixed(2)} kg | Vs avg: +${(currentReferenceWeightKg - previousAvgWeightKg).toFixed(2)} kg`;
            }
            return;
        }
        const latestWeight = Number(series[series.length - 1] || 0);
        const remaining = latestWeight - weightGoalKg;
        if (goalStatusEl) {
            if (remaining > 0) {
                goalStatusEl.textContent = `Current: ${latestWeight.toFixed(2)} kg ( ${remaining.toFixed(2)} kg above goal )`;
            } else if (remaining < 0) {
                goalStatusEl.textContent = `Current: ${latestWeight.toFixed(2)} kg ( ${Math.abs(remaining).toFixed(2)} kg below goal )`;
            } else {
                goalStatusEl.textContent = `Current: ${latestWeight.toFixed(2)} kg (goal reached)`;
            }
        }
        if (deltaStatusEl) {
            const bestDelta = latestWeight - previousBestWeightKg;
            const avgDelta = latestWeight - previousAvgWeightKg;
            deltaStatusEl.textContent = `Vs best (${previousBestWeightKg.toFixed(2)}): ${bestDelta >= 0 ? '+' : ''}${bestDelta.toFixed(2)} kg | Vs avg (${previousAvgWeightKg.toFixed(2)}): ${avgDelta >= 0 ? '+' : ''}${avgDelta.toFixed(2)} kg`;
        }
        const goalLine = labels.map(() => weightGoalKg);

        new Chart(chartEl, {
            type: 'line',
            data: {
                labels,
                datasets: [
                    {
                        label: 'Weight (kg)',
                        data: series,
                        borderColor: '#0ea5e9',
                        backgroundColor: 'rgba(14,165,233,0.18)',
                        fill: true,
                        tension: 0.3,
                        pointRadius: 2.5,
                        pointHoverRadius: 4,
                    },
                    {
                        label: 'Goal (75 kg)',
                        data: goalLine,
                        borderColor: '#f97316',
                        borderWidth: 1.5,
                        borderDash: [6, 4],
                        pointRadius: 0,
                        fill: false,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: true, position: 'bottom' },
                },
                scales: {
                    x: {
                        ticks: {
                            maxTicksLimit: 7,
                        },
                        grid: { color: 'rgba(148,163,184,0.2)' },
                    },
                    y: {
                        grid: { color: 'rgba(148,163,184,0.2)' },
                        title: { display: true, text: 'Weight (kg)' },
                    },
                },
            },
        });
    }

    function renderDailyCaloriesChart() {
        const chartEl = document.getElementById('dailyCaloriesChart');
        const labels = Array.isArray(weightTrend?.labels) ? weightTrend.labels : [];
        const calories = Array.isArray(weightTrend?.calories) ? weightTrend.calories.map((value) => Number(value || 0)) : [];
        if (!chartEl || labels.length === 0 || calories.length === 0) {
            return;
        }

        const ctx = chartEl.getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 240);
        gradient.addColorStop(0, 'rgba(251, 146, 60, 0.95)');
        gradient.addColorStop(1, 'rgba(251, 146, 60, 0.28)');

        new Chart(chartEl, {
            type: 'bar',
            data: {
                labels,
                datasets: [
                    {
                        label: 'Calories',
                        data: calories,
                        backgroundColor: gradient,
                        borderColor: '#ea580c',
                        borderWidth: 1.2,
                        borderRadius: 6,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                },
                scales: {
                    x: {
                        ticks: { maxTicksLimit: 7 },
                        grid: { color: 'rgba(148,163,184,0.2)' },
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(148,163,184,0.2)' },
                        title: { display: true, text: 'Calories' },
                    },
                },
            },
        });
    }

    function renderDailyFlowHologramChart() {
        const chartEl = document.getElementById('dailyFlowHologramChart');
        const labels = Array.isArray(dailyFlowTrend?.labels) ? dailyFlowTrend.labels : [];
        const income = Array.isArray(dailyFlowTrend?.income) ? dailyFlowTrend.income.map((v) => Number(v || 0)) : [];
        const expense = Array.isArray(dailyFlowTrend?.expense) ? dailyFlowTrend.expense.map((v) => Number(v || 0)) : [];
        if (!chartEl || labels.length === 0) {
            return;
        }

        const ctx = chartEl.getContext('2d');
        const incomeGradient = ctx.createLinearGradient(0, 0, 0, 260);
        incomeGradient.addColorStop(0, 'rgba(45, 212, 191, 0.95)');
        incomeGradient.addColorStop(1, 'rgba(45, 212, 191, 0.15)');
        const expenseGradient = ctx.createLinearGradient(0, 0, 0, 260);
        expenseGradient.addColorStop(0, 'rgba(251, 113, 133, 0.95)');
        expenseGradient.addColorStop(1, 'rgba(251, 113, 133, 0.15)');

        new Chart(chartEl, {
            type: 'bar',
            data: {
                labels,
                datasets: [
                    {
                        type: 'bar',
                        label: 'Income',
                        data: income,
                        backgroundColor: incomeGradient,
                        borderColor: '#14b8a6',
                        borderWidth: 1.2,
                        borderRadius: 6,
                    },
                    {
                        type: 'bar',
                        label: 'Expense',
                        data: expense,
                        backgroundColor: expenseGradient,
                        borderColor: '#f43f5e',
                        borderWidth: 1.2,
                        borderRadius: 6,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: '#bae6fd',
                        },
                    },
                    tooltip: {
                        callbacks: {
                            label(context) {
                                const value = Number(context.parsed?.y ?? 0);
                                return `${context.dataset.label}: Rs ${value.toLocaleString()}`;
                            },
                        },
                    },
                },
                scales: {
                    x: {
                        ticks: {
                            color: 'rgba(224, 242, 254, 0.9)',
                            maxTicksLimit: labels.length > 16 ? 16 : labels.length,
                        },
                        grid: { color: 'rgba(148, 163, 184, 0.15)' },
                    },
                    y: {
                        beginAtZero: true,
                        ticks: { color: 'rgba(224, 242, 254, 0.9)' },
                        grid: { color: 'rgba(148, 163, 184, 0.15)' },
                        title: {
                            display: true,
                            text: 'Rs per day',
                            color: 'rgba(186, 230, 253, 0.95)',
                        },
                    },
                },
            },
        });
    }
</script>
</body>
</html>
