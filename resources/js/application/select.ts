function initApplicationSelect() {
    const groups = [
        {
            prefix: 'LANDING-APPLICATION',
            windows: {
                select: 'LANDING-APPLICATION-WINDOW-SELECT',
                student: 'LANDING-APPLICATION-WINDOW-STUDENT',
                individual: 'LANDING-APPLICATION-WINDOW-INDIVIDUAL',
                entity: 'LANDING-APPLICATION-WINDOW-ENTITY',
            },
            buttons: {
                student: 'LANDING-APPLICATION-SELECT-STUDENT_BUTTON',
                individual: 'LANDING-APPLICATION-SELECT-INDIVIDUAL_BUTTON',
                entity: 'LANDING-APPLICATION-SELECT-ENTITY_BUTTON',
            },
        },
        {
            prefix: 'LANDING-MOBILE-APPLICATION',
            windows: {
                select: 'LANDING-MOBILE-APPLICATION-WINDOW-SELECT',
                student: 'LANDING-MOBILE-APPLICATION-WINDOW-STUDENT',
                individual: 'LANDING-MOBILE-APPLICATION-WINDOW-INDIVIDUAL',
                entity: 'LANDING-MOBILE-APPLICATION-WINDOW-ENTITY',
            },
            buttons: {
                student: 'LANDING-MOBILE-APPLICATION-SELECT-STUDENT_BUTTON',
                individual: 'LANDING-MOBILE-APPLICATION-SELECT-INDIVIDUAL_BUTTON',
                entity: 'LANDING-MOBILE-APPLICATION-SELECT-ENTITY_BUTTON',
            },
        },
    ];

    function showWindow(id: string): void {
        const el = document.getElementById(id);
        if (el) el.style.display = 'unset';
    }

    function hideWindow(id: string): void {
        const el = document.getElementById(id);
        if (el) el.style.display = 'none';
    }

    groups.forEach(({ windows, buttons }) => {
        const studentBtn = document.getElementById(buttons.student);
        const individualBtn = document.getElementById(buttons.individual);
        const entityBtn = document.getElementById(buttons.entity);

        if (studentBtn) {
            studentBtn.addEventListener('click', () => {
                hideWindow(windows.select);
                hideWindow(windows.individual);
                hideWindow(windows.entity);
                showWindow(windows.student);
            });
        }

        if (individualBtn) {
            individualBtn.addEventListener('click', () => {
                hideWindow(windows.select);
                hideWindow(windows.entity);
                hideWindow(windows.student);
                showWindow(windows.individual);
            });
        }

        if (entityBtn) {
            entityBtn.addEventListener('click', () => {
                hideWindow(windows.select);
                hideWindow(windows.individual);
                hideWindow(windows.student);
                showWindow(windows.entity);
            });
        }
    });
}

initApplicationSelect();
