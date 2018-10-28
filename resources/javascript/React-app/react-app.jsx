import React from "react";
import ReactDOM from "react-dom";
import Dashboard from "./Dashboard";
import AllEntries from "./AllEntries";

const App = () => {
	let Route = (props) => null;
	switch (JSDATA.component) {
		case 'dashboard':
			Route = (props) => <Dashboard {...props}/>;
			break;
		case 'allEntries':
			Route = (props) => <AllEntries {...props}/>;
			break;
	}

	return (
			<div className={'minimumHeight'}>
				<Route/>
			</div>
	);
};

ReactDOM.render(<App/>, document.getElementById("react-container"));