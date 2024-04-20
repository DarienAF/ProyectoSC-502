
$(function () {
    // Función para cargar datos y poblar un select
    async function loadData(selectId, selectedUserId) {
        const selectDOM = $(`#${selectId}`);

        try {
            const response = await fetch('./index.php?controller=ClassesPage&action=MemberUsers');
            const users = await response.json();

            let options = users.map(user => {
                const selectedAttribute = user.id === selectedUserId ? ' selected' : '';
                return `<option value="${user.id}"${selectedAttribute}>${user.nombre} ${user.apellidos}</option>`;
            }).join('');

            selectDOM.html(options);
        } catch (error) {
            console.error('Error loading data:', error);
        }
    }

    loadData('newClassUserID', null);
    

    $("#createClassBTN").click(() => createClassData());

    
});
