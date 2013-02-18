var Dashboard = {
	start: function(userName) {
		$(".nav .added").click(function() {
			$(this).addClass("disabled").attr("disabled", "disabled").siblings().removeClass("disabled").removeAttr("disabled");
			$("#columnContainer").empty();
			ColumnContainer.start("/dashboard/added", {user:userName});
		});

		$(".nav .likes").click(function() {
			$(this).addClass("disabled").attr("disabled", "disabled").siblings().removeClass("disabled").removeAttr("disabled");
			$("#columnContainer").empty();
			ColumnContainer.start("/dashboard/likes", {user:userName});
		});

	}
}