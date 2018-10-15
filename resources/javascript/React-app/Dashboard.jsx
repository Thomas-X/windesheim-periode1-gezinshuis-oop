import React from 'react';
import styled from "styled-components";
import {Bar} from 'react-chartjs-2';
import Links from './Links';
import Card from './Card';


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

const styles = {
	containerStyled: {
		padding: '2rem 0 2rem 0',
		minHeight: '100vh',
	}
}

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
}

const Dashboard = () => {
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
						<Card>
							<div>
								<h5 className={'card-title'}>Aantallen</h5>
								<p>
									hier staan de verschillende aantallen van de verschillende onderdelen die opgeslagen zijn in het
									systeem.
								</p>
							</div>
						</Card>
					</div>
				</div>
				<Links/>
			</div>
	);
};

export default Dashboard;