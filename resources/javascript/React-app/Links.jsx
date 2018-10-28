import React from 'react';
import Card from './Card';
import _ from 'lodash';
import FilterableInput from "./FilterableInput";


class Links extends React.Component {

	determineField = (val, idx) => {
		return <a key={idx} className={'list-group-item'} style={{textAlign: 'start'}} href={val.link}>{val.name}</a>
	}

	render() {
		return (
				<div className="row">
					<div className="col-sm-12" style={{minHeight: '50vh'}}>
						<FilterableInput
								data={JSDATA.links}
								accessor={'name'}
								title={`links.`}
								subtitle={`hieronder zijn verschillende links om makkelijk de data te beheren.`}
								determineField={(...args) => this.determineField(...args)}
						/>
					</div>
				</div>
		)
	}
}

export default Links;