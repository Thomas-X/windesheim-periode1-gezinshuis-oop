import React from 'react';
import Card from './Card';
import _ from 'lodash';


class Links extends React.Component {
	state = {
		search: '',
	}

	onSearchChange = (e) => {
		this.setState({
			search: e.target.value,
		})
	};

	render() {
		const filteredLinks = JSDATA.links.filter((val) => val.name.indexOf(this.state.search) !== -1)

		return (
				<div className="row">
					<div className="col-sm-12" style={{minHeight: '50vh'}}>
						<Card>
							<h5 id={'links'} className="card-title">links.</h5>
							<p className="card-text">hieronder zijn verschillende links om makkelijk de data te beheren.</p>
							<div className="input-group" style={{marginBottom: '1.5rem'}}>
								<div className="input-group-prepend">
									<span className={'input-group-text'}>
										<i className="fas fa-search" ></i>
									</span>
								</div>
								<input placeholder={'zoek naar een link'} value={this.state.search} className="form-control"
								       onChange={(e) => {
									       this.onSearchChange(e);
								       }}/>
							</div>
							{filteredLinks.map((val, idx) => (
									<a key={idx} className={'list-group-item'} style={{textAlign: 'start'}} href={val.link}>{val.name}</a>
							))}
						</Card>
					</div>
				</div>
		)
	}
}

export default Links;