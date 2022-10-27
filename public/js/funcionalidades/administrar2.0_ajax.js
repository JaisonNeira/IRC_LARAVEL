window.onload = function () {
    $select_dep = document.getElementById('depertamento');






    $select_dep.addEventListener('change', () => {
        const DEP_ID = $select_dep.value
        const sendDatos = {
            'DEP_ID': DEP_ID
        }
        llenarSelect(sendDatos)
    })
}






