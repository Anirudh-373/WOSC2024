<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="imgs/wosc.ico">
    <style>
        .accordion {
            margin: auto;
        }
        .accordion input {
            display: none;
        }
        .box {
            position: relative;
            padding: auto;
            background: white;
            height: 64px;
            transition: all .15s ease-in-out;
        }
        .box::before {
            content: '';
            position: absolute;
            display: block;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            pointer-events: none;
            box-shadow: 0 -1px 0 #e5e5e5,0 0 2px rgba(0,0,0,.12),0 2px 4px rgba(0,0,0,.24);
        }
        header.box {
            background: #084466;
            z-index: 100;
            cursor: initial;
            box-shadow: 0 -1px 0 #e5e5e5,0 0 2px -2px rgba(0,0,0,.12),0 2px 4px -4px rgba(0,0,0,.24);
        }
        header .box-title {
            margin: 0;
            font-weight: normal;
            font-size: 16pt;
            color: white;
            cursor: initial;
            text-align: center;
        }
        .box-title {
            width: calc(100% - 40px);
            height: 64px;
            line-height: 64px;
            padding: 0 20px;
            display: inline-block;
            cursor: pointer;
            -webkit-touch-callout: none;-webkit-user-select: none;-khtml-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;
        }
        .box-content {
            width: calc(100% - 40px);
            padding: 30px 20px;
            font-size: 11pt;
            color: rgba(0,0,0,.54);
            display: none;
        }
        .box-close {
            position: absolute;
            height: 64px;
            width: 100%;
            top: 0;
            left: 0;
            cursor: pointer;
            display: none;
        }
        input:checked + .box {
            height: auto;
            margin: 16px 0;
            box-shadow: 0 0 6px rgba(0,0,0,.16),0 6px 12px rgba(0,0,0,.32);
        }
        input:checked + .box .box-title {
            border-bottom: 1px solid rgba(0,0,0,.18);
        }
        input:checked + .box .box-content,
        input:checked + .box .box-close {
            display: inline-block;
        }
        .arrows section .box-title {
            padding-left: 44px;
            width: calc(100% - 64px);
        }
        .arrows section .box-title:before {
            position: absolute;
            display: block;
           /* content: '\203a';*/
            font-size: 18pt;
            left: 20px;
            top: -2px;
            transition: transform .15s ease-in-out;
            color: rgba(0,0,0,.54);
        }
        input:checked + section.box .box-title:before {
            transform: rotate(90deg);
        }

    </style>
</head>
<body>

<?php include_once("header.php"); ?>
<div id="columnA">
    <!-- <h2>Focal Theme: Sustainable Utilization of Oceans in Blue Economy</h2> -->
    <div class="columnA">
       
        <nav class="accordion arrows">
            <header class="box">
                <label for="acc-close" class="box-title">Lead Speakers</label>
            </header>
            <input type="radio" name="accordion" id="cb1">
            <section class="box">
                <label class="box-title" for="cb1">Dr. V. V. R. Suresh, Scientist, ICAR-CMFRI, Kochi</label>
                <label class="box-close" for="acc-close"></label>
                <!-- <div class="box-content" style="color:black;">Coordinator: <b style="color:blue;">Dr. R. Kirubagaran, NIOT (Rtd.)</b></div> -->
            </section>
            <input type="radio" name="accordion" id="cb2">
            <section class="box">
                <label class="box-title" for="cb2">Dr. Srinivasa Kumar, Director, INCOIS</label>
                <label class="box-close" for="acc-close"></label>
                 <div class="box-content" style="color:black;"> 
                 Dr. Srinivasa Kumar is the Director of Indian National Centre for Ocean Information Services (INCOIS), a leading organization in the field of ocean observation, information and advisory services under the Ministry of Earth Sciences (MoES), Government of India. He has extensive research experience, and held progressively senior techno-managerial positions at premier scientific organisations such as Intergovernmental Oceanographic Commission (IOC) of UNESCO, INCOIS and Indian Space Research Organisation (ISRO). All through his career, he managed large scientific projects delivering high-impact societal services, having led their design, underpinning scientific foundation and implementation, involving multiple national / international institutions, scientists and end users.</br></br>
                 He joined as Director in August 2020 after serving nearly 4 years on an International assignment at IOC-UNESCO Intergovernmental Coordination Group for Indian Ocean Tsunami Warning and Mitigation Systems (ICG/IOTWMS) in Australia as Head of its Secretariat. During his tenure at ICG/IOTWMS, he was instrumental in strengthening the regional tsunami early warning systems in active collaboration with 28 member states, global harmonization of tsunami watch operations and implementation of the Tsunami ready community recognition programme.</br></br>
                 Prior to this international assignment, he served INCOIS since 2001 as Head of the Advisory Services and Satellite Oceanography Group (ASG) that dealt with various national flagship projects. His contributions led to the successful implementation of important projects such as Tsunami Early Warning System, Potential Fishing Zone (PFZ) advisories, Multi Hazard Vulnerability Mapping, Coral Reef Bleaching Alert System, Satellite Coastal and Oceanography Research (SATCORE), etc. which provided valuable and impactful services to the coastal community of India. After the 2004 Indian Ocean Tsunami, he played a pivotal role in establishment of the "Indian National Early Warning Centre for Tsunamis and Storm Surges" at INCOIS, which is a multi-institutional project with heterogeneous components starting from observation platforms to high-power computational systems for modeling to data analysis and decision support systems. He also led the implementation of the national project on "Indian Seismic and GNSS Network (ISGN) and establishment of GNSS & Strong Motion Sensors Network in Andaman & Nicobar Islands.</br></br>
                 He was elected as a Vice-Chair of the IOC for 2021-2023 during the 31st Assembly of Intergovernmental Oceanographic Commission (IOC) of UNESCO. He also represented India on several high-profile intergovernmental committees of IOC-UNESCO, as Chair of ICG/IOTWMS, Chair of Inter-ICG Task Team on Tsunami Watch Operations, Secretary / Officer of Indian Ocean Global Ocean Observing Systems (IOGOOS), as well as Chair of the Disaster & Risk Reduction Working Group of the International Society of Photogrammetry & remote Sensing (ISRPS).</br></br>
                 Srinivasa Kumar was conferred with several national and international awards including the prestigious "National Geosciences Award" in 2010 by the Ministry of Mines towards his contributions in establishing the world-class tsunami early warning centre at INCOIS. He also received the "Indian National Geospatial Award" in 2008, instituted by Indian Society of Remote Sensing (ISRS), for his contributions towards application of geospatial technologies for disaster management. He was recipient of Certificate of Merit given to Young Scientists for the year 2004 by Department of Ocean Development (DOD), presently known as MoES.</br></br>
                 Srinivasa Kumar holds a Ph.D in Marine Science and his research interests include Remote Sensing, Geospatial technologies, Disaster Risk Reduction, Marine Resource Management, Coastal Zone Management and Satellite Oceanography. He is the author of more than 70 scientific publications in international peer reviewed journals and contributed chapters in 5 books.</br>
                </div> 
            </section>
            <input type="radio" name="accordion" id="cb3">
            <section class="box">
                <label class="box-title" for="cb3">Cmde Debesh Lahiri, Executive Director, National Maritime Foundation (NMF)</label>
                <label class="box-close" for="acc-close"></label>
               <div class="box-content" style="color:black;" > <img src="images/Cmde_Debesh_Lahiri.png"> An alumnus of the Naval Engineering Course (NEC), Naval Engineering College, INS Shivaji, Lonavala and College of Defence Management (CDM), Secunderabad, Commodore Debesh Lahiri was commissioned into the Indian Navy on 25 Nov 1988. He is a Marine Engineer by profession and has completed his Master’s (MTech) from Indian Institute of Technology (IIT), Chennai and a Master’s in Management Sciences (MMS) from Osmania University. He has successfully completed a World Bank programme on Alternate Dispute Resolution-Mediation, Conciliation and Arbitration, and has been a member-arbitrator nominated by the Indian Navy in a three-man Arbitral Tribunal in a dispute resolution with Ms Hindustan Construction Company. He was the Commissioning Engineer Officer (Desig) of INS Beas constructed at Ms Garden Reach Shipbuilders and Engineers Limited, Kolkata before being selected as the Deputy Naval Attaché at the Embassy of India, Moscow. He has been closely associated with the classified programme of the Indian Navy being a member of the equipment and systems design and procurement team, as also a member of the Commissioning Review Committee of a classified facility. He has been at the helm of two Naval ship Repair Yards at Port Blair, Andaman and Nicobar Command and Karwar, Western Naval Command respectively looking after the operational availability, maintenance and repair of Indian Naval Ships and Submarines including the Aircraft Carrier INS Vikramaditya.</br></br>
               He has wide experience at sea, having been Engineer Officer on three different types of propulsion, viz. Internal Combustion Engines (Ghorpad), Gas Turbines (Veer) and Steam (Udaygiri, Ganga, Gomati and Beas) and has also been the Fleet Engineer Officer, Western Fleet wherein he was the chief engineering advisor to the Flag Officer Commanding Western Fleet. He has been Additional General Manager (Quality Assurance and Production) at Naval Dockyard, Mumbai, and is well-versed in Human Resource Management, having been Director of Personnel at Naval Headquarters. As Commodore Dockyards, he was responsible for the creation of marine,and technical maintenance and repair infrastructure in the Navy. He has also done a stint as the Deputy Director General Quality Assurance (Warship Production) before taking up his current assignment as the Executive Director of the National Maritime Foundation.</br></br>
               He is a fellow of the Institute of Marine Engineers (FIMarE) and his papers have been published by the American Society of Mechanical Engineers (ASME), Society of Automotive Engineers (SAE), International Naval Engineers Conference (INEC), Indian National IC Engines Conference and the Journal of Marine Engineering. He has also authored service papers on matters of importance to the Indian Navy and has written a dissertation on Comprehensive National Power. His articles and poems on Shipbuilding in Ancient India, Energy, Emissions, Environment, Quality Techniques, Leadership and Personnel Management have been published in Naval Despatch, Personnel Update, among several other magazines and periodicals.</br></br>
               He is a keen sportsman having led the Indian Navy hockey team and captained the football teams of all three commands of the Indian Navy. He loves the outdoors and has completed the basic mountaineering course from the Nehru Institute of Mountaineering, Uttarkashi. He is a cyclist with several long-distance bicycle hikes to his credit, loves trekking and is a weekend-golfer with a handicap of 18. He is an avid reader and sometimes poet.</br></br>
  </div> 
            </section>
            <input type="radio" name="accordion" id="cb4">
            <section class="box">
                <label class="box-title" for="cb4">Dr. R. Krishnan, Director, IITM, Pune Online Talk</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content" style="color:black;">
            </div>
            </section>
            <input type="radio" name="accordion" id="cb5">
            <section class="box">
                <label class="box-title" for="cb5">Dr. K. J. Ramesh, DG, IMD</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content" style="color:black;">
               </div>
            </section>
            <input type="radio" name="accordion" id="cb6">
            <!-- <section class="box">
                <label class="box-title" for="cb6">6. Ocean Summit: Interactions with neighboring countries. (Hybrid)</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content"></div>
            </section> -->
            <section class="box">
                <label class="box-title" for="cb6">Dr. Thamban Meloth, Director, NCPOR</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content" style="color:black;" >
            
                </div>
            </section>
            <input type="radio" name="accordion" id="cb7">
            <section class="box">
                <label class="box-title" for="cb7">Shri. Anup K Mudgal, Retired Ambassador, IFS</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content" style="color:black;">
               </div>
            </section>
            <input type="radio" name="accordion" id="cb8">
            <section class="box">
                <label class="box-title" for="cb8">Dr. Anuradha, Coordinator, Indian Knowledge Systems Division, AICTE Ministry of Education, Govt. of India</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content" style="color:black;">
                
                </div>
            </section>
            <input type="radio" name="accordion" id="cb9">
            <section class="box">
                <label class="box-title" for="cb9">Cdr PK Srivastava, Scientist, MoES</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content" style="color:black;" ></div>
            </section>
            <input type="radio" name="accordion" id="cb10">
            <section class="box">
                <label class="box-title" for="cb10">Dr. G.A. Ramadass, Director, NIOT</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content" style="color:black;">
            </div>
            </section>
            <input type="radio" name="accordion" id="cb11">
            <section class="box">
                <label class="box-title" for="cb11">Prof. S. A. Sannasiraj, Prof. IIT, Chennai</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content" style="color:black;" >
                </div>
            </section> 
            <input type="radio" name="accordion" id="cb12">
            <section class="box">
                <label class="box-title" for="cb12">Rear Admiral Mohammad Musa, OSP, NPP, rcds, afwc, psc, PhD Vice-Chancellor, BSMRMU</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content" style="color:black;">
            </div>
            </section>
            <input type="radio" name="accordion" id="cb13">
            <section class="box">
                <label class="box-title" for="cb10">Dr. M.V. Ramana Murthy, Director, NCCR</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content" style="color:black;">
            </div>
            </section>
            <input type="radio" name="accordion" id="cb14">
            <section class="box">
                <label class="box-title" for="cb14">Dr. B. Meenakumari, Former Chairperson of National Biodiversity Authority</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content" style="color:black;">former DDG (Fisheries) in ICAR, former Director ICAR-CIFT
            </div>
            </section>
            <input type="radio" name="accordion" id="cb15">
            <section class="box">
                <label class="box-title" for="cb15">Dr. Grinson George, Scientist, CMFRI</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content" style="color:black;">
            </div>
            </section>
            <input type="radio" name="accordion" id="cb16">
            <section class="box">
                <label class="box-title" for="cb16">Dr. Tanu Jindal, Director, Amity University, Noida Amity Institute of Environmental Toxicology</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content" style="color:black;">Safety and Management,AIWTM, ACARS, AIOAS
            </div>
            </section>
            <input type="radio" name="accordion" id="acc-close">
        </nav>
    </div>
</div>
<?php include_once("side_menu.php"); ?>
<?php include_once("footer.php"); ?>
</body>
</html>