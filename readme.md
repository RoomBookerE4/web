symfony server:start
php bin/console
php bin/console doctrine:mapping:import "App\Entity" annotation --path=src/Entity

\App\Domain\Auth\...

# Introduction
RoomBooker is a 2nd Engineering School project. Its goal is to book a room in any building, any school or institution, easily by anyone.

# Technical Stack
Technical

# TODO:

- Envoyer une invitation (email) [SIMON]                                                      ✅
- Envoi des mails [SIMON]                                                                     ✅
- Annuler un meeting [SIMON]                                                                  ✅
- Check if room is already booked [SIMON]                                                     ✅
- Accept or reject an invitation [ALEXANDRE]                                                  ✅
- Notify participants of a canceled meeting. [SIMON]                                          ✅
- Rajouter espace entre les deux cards page d'accueil. [SIMON]                                ✅
- Page de consultation d'une réservation/d'un meeting. [SIMON]                                
- Check room is bookable at its own timeOpen and timeClose and maxTime of a room. [ALEXANDRE] ✅
- Add admin and establishment [ALEXANDRE]                                                     
- Gestion des erreurs sur le formulaire de réservation. [ALEXANDRE]                           ✅

- TESTS ! [Alexandre & Simon]