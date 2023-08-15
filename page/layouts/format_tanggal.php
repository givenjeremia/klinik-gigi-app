<script>
    function convertDate(tanggal) {
        const inputDate = tanggal;
        const parsedDate = new Date(inputDate);
        const day = String(parsedDate.getDate()).padStart(2, "0");
        const month = String(parsedDate.getMonth() + 1).padStart(2, "0"); // Months are zero-based
        const year = parsedDate.getFullYear();
        const formattedDate = `${day}-${month}-${year}`;
        return formattedDate;
    }
</script>