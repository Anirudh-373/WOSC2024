<?php include_once("header.php"); ?>
<script type="text/javascript">
	$(document).ready(function() {
		$(".tab_content").hide();
		$(".tab_content:first").show();

		$("ul.tabs li").click(function() {
			$("ul.tabs li").removeClass("active");
			$(this).addClass("active");
			$(".tab_content").hide();
			var activeTab = $(this).attr("rel");
			$("#"+activeTab).fadeIn();
		});
	});
</script>
<div id="columnA">
	<h2>Organizers Committee</h2>
	<!--<div style="width:660px; margin:0px auto;"> -->
		<ul class="tabs">
			<li class="active" rel="tab1">Patrons</li>
			<li rel="tab2"> International Organizing Committee </li>
			<li rel="tab3"> Editorial Board</li>
			<li rel="tab4"> Technical Committee</li>
			<li rel="tab5"> International Advisory Board</li>
			<li rel="tab6"> Exhibition Committee</li>
		</ul>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
				<div class="datagrid">
					<table>
						<thead>
							<tr>
								<th align="center">Patrons </th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td width="50%" style="background:#fff;">
									<b>Dr. Shailesh Nayak </b><br/>
									Chairman, Earth System Science Organization, Govt of India.<br/>&nbsp;<br/>
									MoES.<br/>&nbsp;<br/> IEEE OES India Council.
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div id="tab2" class="tab_content">
				<div class="datagrid">
					<table>
						<thead>
							<tr>
								<th align="center" colspan="2" >International Organizing Committee</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th colspan="2" align="center" bgcolor="#F5B83D"><font color="#2C314D" size="3">Co- Chair</th>
							</tr>
							<tr>
									<td width="50%">Dr. M.A. Atmanand</td>
									<td width="50%">National Institute of Ocean Technology, India</td>
							</tr>
							<tr class="alt">
									<td width="50%">Prof. Tamaki Ura</td>
									<td width="50%">Director, Project Professor of Center <br/>
									  for Socio-Robotic Synthesis, Kyushu Institute of Technology, and <br/>
					Director of Underwater Technology Center of National Maritime Research Institute, Japan</td>
							</tr>
							<tr>
									<td width="50%">Dr. Robert Wernli</td>
									<td width="50%">First Centurion Enterprises, USA</td>
							</tr>

							<tr>
								<th colspan="2" align="center" bgcolor="#F5B83D"><font color="#2C314D" size="3">Members </th>
							</tr>
							<tr>
								<td width="50%">Dr. G. A. Ramadass</td>
								<td width="50%">National Institute of Ocean Technology, India</td>
							</tr>
							<tr class="alt">
								<td width="50%">Dr. R. Venkatesan</td>
								<td width="50%">National Institute of Ocean Technology, India</td>
							</tr>
							<tr>
								<td width="50%">Prof. Rajendar Bahl</td>
								<td width="50%">Indian Institute of Technology Delhi, India</td>
							</tr>
							<tr class="alt">
								<td width="50%">Prof. Anantha Subramaniam</td>
								<td width="50%">Indian Institute of Technology Madras, India</td>
							</tr>
							<tr>
								<td width="50%">Dr. Rajiv Sharma</td>
								<td width="50%">Indian Institute of Technology Madras, India</td>
							</tr>
							<tr class="alt">
								<td width="50%">Mr. S.O. Dinesh Babu</td>
								<td width="50%">Results Marine, India</td>
							</tr>
							<tr>
								<td width="50%">Dr. P. V. Unnikrishnan</td>
								<td width="50%">Saint Gobain, India</td>
							</tr>

							<tr>
							<th align="center" colspan="2" bgcolor="#F5B83D"><font color="black" size="3">Secretariat</th>
							</tr>
							<tr>
								<td width="50%">Mr. Tata Sudhakar (Organizing Secretary)</td>
								<td width="50%">National Institute of Ocean Technology, India</td>
							</tr>
							<tr class="alt">
								<td width="50%">Mr. Shibu Jacob (Treasurer) </td>
								<td width="50%">National Institute of Ocean Technology, India</td>
							</tr>
							<tr>
								<td width="50%">Dr. S.V.S. Phani kumar (Joint secretary)</td>
								<td width="50%">National Institute of Ocean Technology, India</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div id="tab3" class="tab_content">
				<div class="datagrid">
					<table>
						<thead>
							<tr>
							<th align="center" colspan="2">Editorial Board </th>
							</tr>
						</thead>
						<tbody>
							<tr>
							<th align="center" colspan="2" bgcolor="#F5B83D"><font color="black" size="3">Co-chairs </th>
							</tr>
								<tr>
									<td width="50%">Dr. G.A. Ramadass</td>
									<td width="50%">National Institute of Ocean Technology, India</td>
								</tr>
							<tr class="alt">
								<td width="50%">Dr. Dhilsha Rajapan</td>
								<td width="50%">National Institute of Ocean Technology, India</td>
							</tr>
							<tr>
								<td width="50%">Dr. Bishwajit Chakraborty</td>
								<td width="50%">National Institute of Oceanography, India</td>
							</tr>
							<tr class="alt">
								<td width="50%">Dr. Manu Korulla</td>
								<td width="50%">Naval Science and Technology laboratory, India</td>
							</tr>
							<tr>
								<th align="center" colspan="2" bgcolor="#F5B83D"><font color="black" size="3">Members </th>
							</tr>
							<tr>
								<td width="50%">Mr. S. Rajesh</td>
								<td width="50%">National Institute of Ocean Technology, India</td>
							</tr>
							<tr class="alt">
								<td width="50%">Ms. A. Malarkodi</td>
								<td width="50%">National Institute of Ocean Technology, India</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div id="tab4" class="tab_content">
				<div class="datagrid">
					<table>
						<thead>
							<tr>
								<th align="center" colspan="2">Technical Committee </th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th align="center" colspan="2" bgcolor="#F5B83D"><font color="black" size="3">Co-Chairs </th>
							</tr>
							<tr>
								<td width="50%">Dr. R. Venkatesan</td>
								<td width="50%">National Institute of Ocean Technology, India</td>
							</tr>
							<tr class="alt">
								<td width="50%">Dr. G. Latha</td>
								<td width="50%">National Institute of Ocean Technology, India</td>
							</tr>
							<tr>
								<td width="50%">Prof. Rajendar Bahl</td>
								<td width="50%">Indian Institute of Technology Delhi, India</td>
							</tr>
							<tr class="alt">
								<td width="50%">Prof. P.R.S. Pillai</td>
								<td width="50%">Cochin University of Science and Technology, India</td>
							</tr>
							<tr>
								<th align="center" colspan="2" bgcolor="#F5B83D"><font color="black" size="3">Members </th>
							</tr>
							<tr>
								<td width="50%">Mr. R. Madan</td>
								<td width="50%">National Institute of Oceanography, India</td>
							</tr>
							<tr class="alt">
								<td width="50%">Mr. P. Muthuvel</td>
								<td width="50%">National Institute of Ocean Technology, India</td>
							</tr>
							<!--<tr class="alt">
								<th align="center" colspan="2" bgcolor="#F5B83D"><font color="black" size="3">Members </th>
							</tr>-->
							<tr>
								<td width="50%">Ms. Nidhi Varshney</td>
								<td width="50%">National Institute of Ocean Technology, India</td>
							</tr>

							<tr class="alt">
								<td width="50%">Ms. K. Chithra</td>
								<td width="50%">National Institute of Ocean Technology, India</td>
							</tr>
							<tr >
								<td width="50%">Mr. S. Muthukumaravel </td>
								<td width="50%">National Institute of Ocean Technology, India</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div id="tab5" class="tab_content">
				<div class="datagrid">
					<table>
						<thead>
							<tr>
								<th align="center" colspan="2">International Advisory Board </th>
							</tr>
						</thead>
						<tbody>
						<tr>
							<th align="center" colspan="2" bgcolor="#F5B83D"><font color="black" size="3">Co-Chairs </th>
						</tr>
						<tr>
							<td width="50%">Prof. V.G. Idichandy</td>
							<td width="50%">Indian Institute of Technology Madras, India</td>
						</tr>
						<tr class="alt">
							<td width="50%">Dr. Ehrlich Desa</td>
							<td width="50%">Distinguished Scientist at Council of Scientific and Industrial Research, India</td>
						</tr>
						<tr>
							<td width="50%">Dr. James McFarlane</td>
							<td width="50%">International Submarine Engineering Ltd., Canada</td>
						</tr>
						<tr>
							<th align="center" colspan="2" bgcolor="#F5B83D"><font color="black" size="3">Members </th>
						</tr>
						<tr>
							<td width="50%">Dr. V. Bhujanga Rao</td>
							<td width="50%">Defence Research and Development Organisation, India</td>
						</tr>
						<tr class="alt">
							<td width="50%">Dr. Jerry Carroll (U.S.A.)</td>
							<td width="50%">IEEE Oceanic Engineering Society</td>
						</tr>
						<tr>
							<td width="50%">Dr. James S. Collins</td>
							<td width="50%">IEEE, Canada</td>
						</tr>
						<tr class="alt">
							<td width="50%">Dr. James Barbera</td>
							<td width="50%">OES (USA), IEEE Oceanic Engineering Society</td>
						</tr>
						<tr>
							<td width="50%">Dr. Mandar Chitre</td>
							<td width="50%">Singapore</td>
						</tr>
						<tr class="alt">
							<td width="50%">Dr. Akira Asada</td>
							<td width="50%">Institute of Industrial Science, Japan </td>
						</tr>
						<tr>
							<td width="50%">Ms. Harumi Sugimatsu</td>
							<td width="50%">Institute of Industrial Science, Japan</td>
						</tr>
						<tr class="alt">
							<td width="50%">Dr. Sergey Ya. Sukonkin</td>
							<td width="50%">Russian Academy of Sciences - Experimental Design Bureau of Oceanological Engineering, Russia</td>
						</tr>
						<tr>
							<td width="50%">Dr. S. C. Shenoi</td>
							<td width="50%">Indian National Centre for Ocean Information Services, India</td>
						</tr>
						<tr class="alt">
							<td width="50%">Dr. S. Rajan</td>
							<td width="50%">National Centre for Antarctic and Ocean Research, India</td>
						</tr>
						<tr>
							<td width="50%">Shri. S. Anantha Narayanan</td>
							<td width="50%">Naval Physical Oceanography Laboratory, India</td>
						</tr>
						<tr class="alt">
							<td width="50%">Dr. C.D. Malleswar</td>
							<td width="50%">Naval Science and Technology Laboratory, India</td>
						</tr>
						<tr>
							<td width="50%">Dr. S. K. Das</td>
							<td width="50%">Ministry of Earth Sciences, India</td>
						</tr>
						<tr class="alt">
							<td width="50%">Dr. M.P. Wakdikar</td>
							<td width="50%">Ministry of Earth Sciences, India</td>
						</tr>
						<tr>
							<td width="50%">Dr. M.  Sudhakar</td>
							<td width="50%">Ministry of Earth Sciences, India</td>
						</tr>
						<tr class="alt">
							<td width="50%">Dr. António M. S. Pascoal</td>
							<td width="50%">Instituto Superior Tecnico (IST), Portugal</td>
						</tr>
						<tr>
							<td width="50%">Dr. Katsuyoshi Kawaguchi</td>
							<td width="50%">Japan Agency for Marine-Earth Science and Technology, Japan</td>
						</tr>
						<tr class="alt">
							<td width="50%">Dr. Joao Borges de Souza</td>
							<td width="50%">Porto University, Portugal</td>
						</tr>
						<tr>
							<td width="50%">Dr. Yoshiyuki Kaneda</td>
							<td width="50%">Japan Agency for Marine-Earth Science and Technology, Japan</td>
						</tr>
						<tr class="alt">
							<td width="50%">Dr. William Kirkwood</td>
							<td width="50%">Monterey Bay Aquarium Research Inst, USA</td>
						</tr>
						<tr>
							<td width="50%">Dr. Kenichi Asakawa</td>
							<td width="50%">Japan Agency for Marine-Earth Science and Technology, Japan	</td>
						</tr>
						<tr class="alt">
							<td width="50%">Dr. Nuno A. Cruz</td>
							<td width="50%">INESC TEC and University of Porto, Portugal</td>
						</tr>
						<tr>
							<td width="50%">Dr. Ken Takagi</td>
							<td width="50%">The University of Tokyo, Japan</td>
						</tr>
						<tr class="alt">
							<td width="50%">Prof. Hisashi Utada</td>
							<td width="50%">The University of Tokyo, Japan</td>
						</tr>
						<!--<tr class="alt">
							<td width="50%">Dr. M.R. Arshad</td>
							<td width="50%">Underwater Robotics Research Group, Malaysia</td>
						</tr>-->
						<tr>
							<td width="50%">Prof. Propero C. Naval Jr.</td>
							<td width="50%">University of Philippines, Philippines</td>
						</tr>
						<tr class="alt">
							<td width="50%">Prof. Forng –Chen Chiu</td>
							<td width="50%">National Taiwan University, Taiwan</td>
						</tr>
						<tr>
							<td width="50%">Dr. Tatsuro Akiba</td>
							<td width="50%">National Institute of Advanced Industrial Science and Technology, Japan</td>
						</tr>
						<tr class="alt">
							<td width="50%">Dr. Ki-Hun Kim</td>
							<td width="50%">Maritime and Ocean Engineering Research Institute, Korea</td>
						</tr>
						<tr>
							<td width="50%">Prof.  Arun Kumar</td>
							<td width="50%">Indian Institute of Technology Delhi, India</td>
						</tr>
						<tr class="alt">
							<td width="50%">Dr. N.R. Alamelu</td>
							<td width="50%">IEEE Madras Section, India</td>
						</tr>
						<tr>
							<td width="50%">Dr. Taira Hotta</td>
							<td width="50%">Japan Agency for Marine-Earth Science and Technology, Japan</td>
						</tr>

						<tr class="alt">
							<td width="50%">Prof. Mohd Rizal bin Arshad</td>
							<td width="50%">Universiti Sains Malaysia</td>
						</tr>
						<tr>
							<td width="50%">Prof. Lian Lian</td>
							<td width="50%">Shanghai Jiao Tong University, China</td>
						</tr>
						<tr class="alt">
							<td width="50%">Prof. Wen Xu</td>
							<td width="50%">Zhejiang University, China</td>
						</tr>
						<tr>
							<td width="50%">Prof. Woojae Seong</td>
							<td width="50%">Seoul National University, Korea</td>
						</tr>

						<tr class="alt">
							<td width="50%">Prof. Son-Cheol Yu</td>
							<td width="50%">Pohang University of Science and Technology(POSTECH), Korea</td>
						</tr>
						<tr>
							<td width="50%">Prof. Jen-Hwa Guo</td>
							<td width="50%">National Taiwan University, Taiwan</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div id="tab6" class="tab_content">
				<div class="datagrid">
					<table>
						<thead>
							<tr>
							  <th align="center" colspan="2">Exhibition Committee</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								  <td width="30%">Mr. N. Vedachalam</td>
								  <td width="30%">National Institute of Ocean Technology, India</td>
							</tr>
							<tr class="alt">
								  <td width="30%">Mr. R. Srinivasan</td>
								  <td width="30%">National Institute of Ocean Technology, India</td>
							</tr>
							<tr>
								  <td width="30%">Mr. Arul Muthiah </td>
								  <td width="30%">National Institute of Ocean Technology, India</td>
							</tr>
							<tr class="alt">
								  <td width="30%">Mr. S. Rajesh </td>
								  <td width="30%">National Institute of Ocean Technology, India</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

	</div> <!-- .tab_container -->
</div>
<?php include_once("side_menu.php"); ?>
<?php include_once("footer.php"); ?>