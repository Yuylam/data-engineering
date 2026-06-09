# Network Communications
This course introduces fundamental concepts of computer networks and data communication. It is based on the TCP/IP Internet protocol stack, where each layer is studied and analysed to understand how data is transmitted across networks.

- [Course content](#course-content)
- [Lab](#lab)
- [Project](#project)
- [Reflection](#reflection)

## Course content
- Computer Networks and the Internet  
Fundamentals of computer networks including network edge and core, packet switching, delays and loss, protocol layers, and the evolution of the Internet.
- Application Layer  
Network applications and protocols such as HTTP, DNS, email systems, peer-to-peer applications and content distribution networks.
- Transport Layer  
Transport services including multiplexing and demultiplexing, reliable data transfer, TCP protocol and congestion control mechanisms.
- Network Layer (Data & Control Plane)  
IP addressing (IPv4 and IPv6), routing concepts, fragmentation, Network Address Translation (NAT), ICMP, routing algorithms and software-defined networking (SDN).
- Link Layer and LANs  
Error detection and correction, multiple access protocols, MAC addressing, ARP, and switched LAN operations.
- Wireless and Mobile Networks  
Wireless communication characteristics, WiFi (802.11), cellular networks, mobility management and mobile IP concepts.

## Lab
### [Lab 1 Packet Analysis at Application Layer using Wireshark](/network-communications/lab1-packet-analysis-at-application-layer.pdf)
In this lab, Wireshark was used to analyse application layer protocols such as HTTP and DNS. The HTTP GET and response messages were examined to understand how data is exchanged between client and server, including status codes, content transfer and caching mechanisms like conditional GET. Additionally, DNS queries and responses were inpected to understand how domain names are resolved into IP addresses.

### [Lab 2 TCP and UDP Communication using Packet Tracer](/network-communications/lab2-tcp-and-udp-communications.pdf)
In this lab, Cisco Packet Tracer is used to observe how TCP and UDP protocols fucntion in network communication. Different types of traffic, including HTTP, FTP, DNS and email is generated. The data transmitted using protocol data units (PDUs) is analysed. Through this simulation, I explored concepts such as multiplexing, port numbers, and the differences between TCP and UDP. I observed that TCP provides reliable communication with sequence and acknowledgment numbers, while UDP is connectionless and does not guarantee delivery.

### [Lab 3 Routing Protocols](/network-communications/lab3-routing-protocol.pdf)
In this lab, the network layer concepts were explored by performing subnetting and configuring routing in a multi-router topology. Subnet addresses were calculated based on given requirements and IP configurations were assigned to routers and PCs. Routing tables are analysed and the connectivity between devices are tested. By implementing RIP protocol, successful communication across different networks was achieved. Additionally, it was observed that changes in network addressing require reconfiguration and proper route updates to maintain connectivity.

### [Lab 4 ARP and Switch Table Communications](/network-communications/lab4-arp-and-switch-table-communications.pdf)
In this lab, communication within and across networks was analysed by examining ARP tables and MAC address tables using Packet Tracer. ARP was used to map IP addresses to MAC addresses, and table entries were observed to update during network communication. Communication within the same subnet and across different subnets was compared, showing that packets are forwarded to the default gateway when the destination is outside the local network. In addition, switch MAC address tables were examined to understand how frames are forwarded at the data link layer. Overall, the lab demonstrated how ARP and MAC addressing mechanisms work together to support network communication.

## Project
- [Final Report](/network-communications/project-final-report.pdf)
- [Individual Report](/network-communications/project-individual-report.pdf)

In this project, a network solution for a building was designed. A floor plan was created according to requirements, considering performance, scalability, security, power consumption and budget. Networking devices including routers, switches, access points and a firewall were evaluated and selected based on specifications and cost. The network layout was then planned by designing floor plans, arranging devices and determining cable connections. Additionally, an IP addressing scheme using subnetting was developed to allocate resources across different rooms and labs. This project provided practical experience in network planning, device selection and applying theoretical concepts such as routing, subnetting and network design in a real-world scenario.

## Reflection
As the Internet is often used daily without much thought about its underlying mechanisms, this course provides insight into what happens behind the scenes. While understanding may remain at a foundational level, it helps uncover part of how network communication works and how data is transmitted across systems.