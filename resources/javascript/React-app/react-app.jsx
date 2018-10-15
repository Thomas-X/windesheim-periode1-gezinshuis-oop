import React from "react";
import ReactDOM from "react-dom";
import Dashboard from "./Dashboard";


const App = () => {
	let Route = (props) => null;

	switch (JSDATA.component) {
		case 'dashboard':
			Route = (props) => <Dashboard {...props}/>;
			break;
	}

	return (
			<div>
				<Route/>
			</div>
	);
};

ReactDOM.render(<App/>, document.getElementById("react-container"));