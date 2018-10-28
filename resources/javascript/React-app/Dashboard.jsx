import React, {Component} from 'react';
import styled from "styled-components";
import {Bar, Line} from 'react-chartjs-2';
import Links from './Links';
import Card from './Card';
import RefLink from "./RefLink";
import {format, differenceInDays} from 'date-fns';

const DashboardContainer = styled.div`
  width: 90%;
  margin: auto;
  padding: 1.5rem 0.5rem 1.5rem 0.5rem;
  
  @media screen and (max-width: 768px) {
    & {
      width: 95%;
    }
  }
`;

const CardContainer = styled.div`
	display: flex;
	flex-direction: column;
	justify-content: space-around;
	height: 100%;
`;

const Flex1Card = styled(Card)`
	flex: 1;
`;

export const styles = {
	containerStyled: {
		padding: '2rem 0 2rem 0',
		minHeight: '100vh',
	}
}

class Dashboard extends Component {
	state = {
		howManyDaysBack: 7,
		actualDaysBackState: 7,
	};

	onDaysBackChange = (howManyDaysBack) => {
		// 365 already is alot of DOM elements
		if (howManyDaysBack < 1001) {
			this.setState({
				actualDaysBackState: howManyDaysBack
			});
			if (howManyDaysBack > 0 && !!howManyDaysBack) {
				this.setState({
					howManyDaysBack,
				})
			}
		}
	};

	render() {
		const data = {
			labels: JSDATA.counts
					.slice(0)
					.map((val, idx) => val.name),
			datasets: [
				{
					label: 'Aantal in de database opgeslagen',
					backgroundColor: 'rgba(255,99,132,0.2)',
					borderColor: 'rgba(255,99,132,1)',
					borderWidth: 1,
					hoverBackgroundColor: 'rgba(255,99,132,0.4)',
					hoverBorderColor: 'rgba(255,99,132,1)',
					data: JSDATA.counts
							.slice(0)
							.map((val, idx) => val.count)
				}
			]
		};
		const day_date = (howManyDaysToGoBack) => {
			const date = new Date();
			let day = date - (1000 * 60 * 60 * 24 * howManyDaysToGoBack);
			return format(new Date(day), 'YYYY-MM-DD');
		};
		const procedingNumbers = [];
		for (let r = 0; r < this.state.howManyDaysBack;r++) {
			procedingNumbers.push(r);
		}
		procedingNumbers.push(this.state.howManyDaysBack);
		const lastDays = procedingNumbers.map((val, idx) => day_date(val));
		const lastLoginData = JSDATA.lastLoginData.slice()
		// only include dates within days range
				.filter((val) => {
					const diff = differenceInDays(format(val.lastLogin, 'YYYY-MM-DD'), day_date(this.state.howManyDaysBack));
					return diff <= this.state.howManyDaysBack && diff >= 0;
				})
				.map((val) => val.lastLogin);
		let sums = [];
		let sums_dates = [];
		lastLoginData
				.forEach((val, idx) => {
					const index = sums_dates.findIndex(dval => dval === val);
					if (index === -1) {
						sums_dates[idx] = val;
						sums[idx] = 1;
					} else {
						sums[index] += 1;
					}
				});
		const sums_with_zeros = [];
		for (let i = 0; i < lastDays.length; i++) {
			let shouldContinue = false;
			for (let o = 0; o < sums_dates.length; o++) {
				if (sums_dates[o] === lastDays[i]) {
					sums_with_zeros[i] = sums[o];
					shouldContinue = true;
					break;
				}
			}
			if (shouldContinue) {
				continue;
			}
			sums_with_zeros[i] = 0;
		}
		const login_data = {
			labels: [
				...lastDays
			],
			datasets: [
				{
					label: `In de afgelopen ${this.state.howManyDaysBack} dagen ingelogd`,
					backgroundColor: 'rgba(255,99,132,0.2)',
					borderColor: 'rgba(255,99,132,1)',
					borderWidth: 1,
					hoverBackgroundColor: 'rgba(255,99,132,0.4)',
					hoverBorderColor: 'rgba(255,99,132,1)',
					data: sums_with_zeros
				}
			]
		};
		const {parents_caretakers, profile, users} = JSDATA.hrefLinks;
		return (
				<div className={'container'} style={styles.containerStyled}>
					<div className={'row'}>
						<div className="jumbotron jumbotron-fluid col-sm-12 col-md-6">
							<div className="container">
								<h1 className="display-5">beheersysteem dashboard</h1>
							</div>
						</div>
						<div className="col-md-6 col-sm-12">
							<Card>
								<div>
									<h5 className={'card-title'}>Hier kan je onderdelen van het systeem beheren, zoals:</h5>
									<ul>
										{[
											'Rechten inzien van kinderen, ouders en behandelaars',
											`Gebruikers toevoegen, aanpassen en verwijderen. Dit kan voor de meeste onderdelen van het systeem. Zie de <a className='list-group-item' href="${location.pathname}#links">links</a> voor meer informatie`
										].map((val, idx) => (
												<li dangerouslySetInnerHTML={{__html: val}} key={idx}>
												</li>
										))}
									</ul>
								</div>
							</Card>
						</div>
					</div>
					<br/>
					<Card>
						<div className="input-group">
							<div className="input-group-prepend">
								<span className="input-group-text">Aantal dagen terug</span>
							</div>
							<input className={'form-control'} value={this.state.actualDaysBackState} onChange={(e) => this.onDaysBackChange(e.target.value)}/>
						</div>
						<div className="row">
							<div className="col-sm-12">
								<Line
										data={login_data}
										width={100}
										height={350}
										options={{
											maintainAspectRatio: false,
										}}
								/>
							</div>
						</div>
					</Card>
					<div className="row">
						<div className="col-sm-12 col-md-8">
							<Bar
									data={data}
									width={100}
									height={500}
									options={{
										maintainAspectRatio: false,
									}}
							/>
						</div>
						<div className="col-sm-12 col-md-4">
							<CardContainer>
								<Flex1Card>
									<div>
										<h5 className={'card-title'}>aantallen</h5>
										<p>
											hier staan de verschillende aantallen van de verschillende onderdelen die opgeslagen zijn in het
											systeem.
										</p>
									</div>
								</Flex1Card>
								<Flex1Card>
									<div>
										<h5 className={'card-title'}>profiellen</h5>
										<p>
											Om een gebruiker te linken aan een profiel (ouder/verzorger,kind,behandelaar,medewerker), moet je
											naar <RefLink link={users} name={'gebruikers'}/> gaan en de gebruiker die je wilt linken aanpassen /
											aanmaken.
										</p>
									</div>
								</Flex1Card>
							</CardContainer>
						</div>
					</div>
					<Links/>
				</div>
		);
	}
}

export default Dashboard;