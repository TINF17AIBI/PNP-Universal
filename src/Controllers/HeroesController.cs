using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using PnP_Universal.Models;

namespace PnP_Universal.Controllers
{
    [Produces("application/json")]
    [Route("api/Heroes")]
    public class HeroesController : Controller
    {
        private readonly PnPContext _context;

        public HeroesController(PnPContext context)
        {
            _context = context;
        }

        // GET: api/Heroes
        [HttpGet]
        public IEnumerable<Heroes> GetHeroes()
        {
            return _context.Heroes;
        }

        // GET: api/Heroes/5
        [HttpGet("{id}")]
        public async Task<IActionResult> GetHeroes([FromRoute] int id)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            var heroes = await _context.Heroes.SingleOrDefaultAsync(m => m.Id == id);

            if (heroes == null)
            {
                return NotFound();
            }

            return Ok(heroes);
        }

        // PUT: api/Heroes/5
        [HttpPut("{id}")]
        public async Task<IActionResult> PutHeroes([FromRoute] int id, [FromBody] Heroes heroes)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != heroes.Id)
            {
                return BadRequest();
            }

            _context.Entry(heroes).State = EntityState.Modified;

            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!HeroesExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return NoContent();
        }

        // POST: api/Heroes
        [HttpPost]
        public async Task<IActionResult> PostHeroes([FromBody] Heroes heroes)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            _context.Heroes.Add(heroes);
            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateException)
            {
                if (HeroesExists(heroes.Id))
                {
                    return new StatusCodeResult(StatusCodes.Status409Conflict);
                }
                else
                {
                    throw;
                }
            }

            return CreatedAtAction("GetHeroes", new { id = heroes.Id }, heroes);
        }

        // DELETE: api/Heroes/5
        [HttpDelete("{id}")]
        public async Task<IActionResult> DeleteHeroes([FromRoute] int id)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            var heroes = await _context.Heroes.SingleOrDefaultAsync(m => m.Id == id);
            if (heroes == null)
            {
                return NotFound();
            }

            _context.Heroes.Remove(heroes);
            await _context.SaveChangesAsync();

            return Ok(heroes);
        }

        private bool HeroesExists(int id)
        {
            return _context.Heroes.Any(e => e.Id == id);
        }
    }
}