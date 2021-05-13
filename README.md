# IT490Spotify
The Changelog

IT490 Project Proposal

Team Name: GDSM (God Damn Systems Man) 
Members: Sana Sajid (member A), Pratibha Goel (member B), Mansi Mangukiya (member C), Shivam Desai (member D), David Romero
Project Name: Music Night
Project Summary: The application will be a music database using Spotify API. Users will be able to select and agree on music to listen together. Random playlists will be generated based on their music preferences. 

Github accounts: 

Trello: 
https://trello.com/b/RiBfTfDD 
https://trello.com/b/RiBfTfDD.json 

Relevant Communications: iMessage group chat: Spotify Project 


## Server 1: Shivam Desai
Specs of Host (MacBook Pro 13 inch, 2020, Two Thunderbolt 3 Ports):

> 1. macOS Big Sur version 11.2.3
> 2. 1.4 GHz Quad-Core Intel Core I5 processor
> 3. 8GB 2133 MHz DDR3 Ram
> 4. 250 GB Flash Storage
> 5. Intel Iris Plus Graphics 645 1536 MB

Specs of Virtual Machine (Oracle VirtualBox Manager version 6.1.18 r142142):

> 1. Ubuntu 20.0.4 (64-bit)
> 2. 2564 MB Base Memory
> 3. 2 processor with a PIIX3 chipset
> 4. 105 MB Video Memory (Scale factor 2.0)
> 5. VMSVGA controller
> 6. 30GB Memory 
> 7. Controller: SATA/IDE
> 8. Audio driven by Core Audio driver and ICH AC97 Controller
> 0. Intel PRO/1000 MT Desktop (NAT) network adapter


Software needed- 
> VirtualBox (latest version) 
> 
> Ubuntu 20.0.4 LTS OS file

Software needed for command line setup
> install packages for GitHub
> 
> clone github repo for rabbitmq example (https://github.com/engineerOfLies/rabbitmqphp_example.git)
> 
> clone GitHub repo for project (https://github.com/shivam-desai/IT490Spotify.git)
> 
> install packages for RabbitMQ
> 
> Install Docker, Apache2, MySQL, SSL, and Cisco Anyconnect VPN

Settings configured: 
> Allow a minimum of 30 GB of data storage for the VM
> 
> At least 2 cores with around half of available memory for the virtual machine 
> 
> Half of available video memory for the virtual machine.


## Server 2: Pratibha Goel
Specs (OS, Memory, HD, VM environment, etc)
> 1. macOS High Sierra version 10.13.6
> 2. Processor 1.8 GHz Intel Core i5
> 3. Memory 8 GB 1600 MHz DDR3
> 4. Startup Disk Macintosh HD
> 5. Graphics Intel HD Graphics 6000 1536 MB
> 6. Built-in Display MacBook Air 13.3-inch (1440 x 900)
> 7. Macintosh HD
> 8. Oracle VM VirtualBox Manager
> 9. Ubuntu 20.0.4 (64 bit)
> 10. Base Memory 4096 MB
> 11. Boot Order Hard Disk, Floppy, Optical
> 12. Acceleration VT-x/AMD-V, Nested Paging, KVM Paravirtualization 
> 13. Video Memory 16 MB
> 14. Graphics Controller VMSVGA
> 15. Controller IDE
> 16. IDE Secondary Device 0: [Optical Drive] ubuntu-20.04.1-desktop-amd64.iso (2.59 GB)
> 17. Controller SATA
> 18. SATA Port 0: IT490002.vdi (Normal, 30.00 GB)
> 19. Host Driver CoreAudio
> 20. Controller ICH AC97
> 21. Adapter 1: Intel PRO/1000 MT Desktop (NAT)
> 22. USB Controller OHCI

Software to Install
> VirtualBox Version 6.1.18 r142142 (Qt5.6.3)
>
> Ubuntu 20.04.1-desktop-amd64.iso

Settings to Configure
> Cisco AnyConnect VPN
>
> Enough storage space for VM
>
> Git clone rabbitmqphp_example from enginnerOfLies


## Server 3: Mansi Mangukiya
Specs: Macbook Pro 13 inch, 2020 Four Thunderbolt 3 ports)
> macOS Big Sur version 11.2.3
> Processor: 2 GHz Quad-Core Intel Core i5
> Memory: 16 GB 3733 MHz LPDDR4X
> Graphics: Intel Iris Plus Graphics 1536 MB
> Built-in Retina Display 13.3-inch (2560 × 1600)
> Storage 512GB
>
Ubuntu Specifications: (Virtual Box) 
> Version 20.0.4 (64 bit )
> Display
> Video memory: 16MB
> Screens: 2
> Scale Factor: 2.20
> Graphics Controller: VMSVGA
> Storage
> Controller: IDE/SATA
> VDI: Normal, 30.00GB
> Audio
> CoreAudio
> Controller: ICH AC97
> Network
> Adapter 1: Intel PRO/1000 MT Desktop (NAT)
> 
Secondary Server
	Server Setup: The servers are designed to monitor and collect the data from when the users would login or register in our app. The servers are setup that they can collect information and then we can monitor them. The main server which was Shivam’s server was setup using various types of softwares. During the beginning of this project the setup was quite simple, downloading the softwares that were given to us from our professor. Once those softwares were downloaded and installed to a setting that we needed to work on our project, we then had to setup a main vm that was going to run the site. We began by cloning a git repository that was provided to us (https://github.com/engineerOfLies/rabbitmqphp_example)
  
The packages downloaded were: MySQL, RabbitMQ, Apache2, CiscoVPN connect for the VPN setting. 

## Server 4: Sana Sajid
Specs (OS, Memory, HD, VM environment, etc)
> 1. MacBook Pro (13-inch, 2020) 
> 2. macOS Big Sur version 11.2.2
> 3. Processor 2 GHz Quad-Core Intel Core i5
> 4. Memory 16 GB 
> 5. Startup Disk Macintosh HD
> 6. Graphics Intel Iris Plus Graphics 1536 MB

VM environment:
> 1. Ubuntu 20.0.4 (64 bit) 
> 2. Video Memory: 16 MB 
> 3. Base Memory: 5712 MB
> 4. Controller: SATA
> 5. Network: Intel PRO/1000 MT Desktop (NAT)
> 6. Host Driver: CoreAudio 
> 7. Controller: ICH AC97 
> 8. Software to install
> 9. VirtualBox 6.1
> 10. Ubuntu 20.0.4 LTS
> 11. Git (from command line)

Settings to configure: 
> Allowed recommended RAM to be allocated to the virtual machine 
> 
> Allowed size of virtual hard disk to be at least 30 GB
> 
> Selected Ubuntu as virtual optical disk file as a startup disk 
> 
> Minimal installation and installed third party software for graphics and WiFi hardware and additional media formats for Ubuntu installation 
> 
> Git clone engineeroflies rabbitmqphp_example
> 
> Cisco AnyConnect VPN 

## Server 5: David Romero 
> 1. Host Specs
> 2. Windows Desktop (Windows 10 Home)
> 3. Processor: AMD Ryzen 3 3200G with Radeon Vega Graphics 3.60 GHz
> 4. Installed Ram: 32.0 GB
> 5. Storage: 500 GB

Virtual Machine:
> 1. Ubuntu 20.04.2 LTS
> 2. Base Memory: 6000 MB
> 3. Video Memory: 16 MB
> 4. Network : Intel PRO/1000 MT Desktop(NAT)
> 5. Host Drive for audio: Windows DirectSound
> 6. Storage- Controller SATA 0
> 7. Software Needed:
> 8. Latest Version of Virtual Box
> 9. Ubuntu 20.04.2.0 LTS
> 10. Cisco AnyConnect 

Settings to be configured
> Set RAM to recommended size
> 
> Set Storage to minimum of 30 GB
> 
> Use Git to clone https://github.com/engineerOfLies/rabbitmqphp_example
> 
> Download and install Cisco VPN





